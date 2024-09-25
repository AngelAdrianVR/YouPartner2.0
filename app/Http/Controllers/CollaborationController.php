<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollaborationResource;
use App\Http\Resources\HomeworkResource;
use App\Models\Collaboration;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function index(Request $request)
    {
        $exclude_if_i_applied_to_collaborate = true;
        $filters = $request->all('search');
        $homeworks = HomeworkResource::collection(Homework::noCollaborationApproved($exclude_if_i_applied_to_collaborate)
        ->whereDate('limit_date', '>=', today())
        ->where('user_id', '!=', auth()->id())
        ->filter($filters)
            ->with(['schoolSubject', 'user.level', 'media', 'chats' => ['users', 'messages.user']])
            ->latest()
            ->paginate(150));

        $homeworks->each(function ($homework, $index) use ($homeworks) {
            if ($homework->status() != 0) $homeworks->splice($index, 1);
        });

        // return $homeworks;

        return inertia('Collaborations/Index', compact('homeworks', 'filters'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $request->validate([
            'price' => 'required|numeric|min:50',
            'promise_date' => 'required|date|after:yesterday',
            'homework_id' => 'required|numeric|min:1',
            // 'user_id' => CollaborationObserver,
            // 'tax' => CollaborationObserver,
        ]);

        $collaboration = Collaboration::create($request->validated());

        // $collaboration->homework->user->notify(new AppliedCollaborationNotification($collaboration->homework->title));

        return redirect()->route('collaborations.approve-pendent')->with('message', 'Aplicaste a una colaboración. Espera la aprobación');
    }

    public function show(Collaboration $collaboration)
    {
        //
    }

    public function edit(Collaboration $collaboration)
    {
        //
    }

    public function update(Request $request, Collaboration $collaboration)
    {
        //
    }

    /**
     * update collaboration with multiple resources. Set collaboration completed
     */
    public function updateP(Request $request)
    {
        $request->validate([
            'completed_comments' => 'required|max:250',
            'resources' => 'required',
        ]);
        
        $collaboration = Collaboration::find($request->collaboration_id);
        $validated_data = $request->validated();
        $collaboration->update([
            'completed_comments' => $validated_data['completed_comments'],
            'completed_date' => now()->toDateString(),
        ]);

        $collaboration->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        // $collaboration->homework->user->notify(new CollaborationCompletedNotification($collaboration->homework->title));
        // User::where('email', 'soporte@youpartner.xphere.com.mx')->first()->notify(new SetReminderForAutoReleasePayment($collaboration));

        return redirect()->route('collaborations.completed')->with('message', 'Colaboración completada');
    }

    public function destroy(Collaboration $collaboration)
    {
        $collaboration->delete();
        return redirect()->route('collaborations.approve-pendent')->with('message', 'Se eliminó la colaboración');
    }

    // My views (tabs) ----------------
    public function approvePendent(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->whereNull('approved_at')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return inertia('Collaborations/ApprovePendent', compact('collaborations'));
    }

    public function inProcess(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->whereNotNull('approved_at')
            ->whereNull('completed_date')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return inertia('Collaborations/InProcess', compact('collaborations'));
    }

    public function completed(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->doesntHave('claim')
            ->whereNotNull('completed_date')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']], 'rate'])
            ->latest('completed_date')
            ->paginate());

        return inertia('Collaborations/Completed', compact('collaborations'));
    }

    public function claims(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->has('claim')
            ->filter($filters)
            ->with(['claim', 'user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return inertia('Collaborations/Claims', compact('collaborations'));
    }

    // Other methods
    public function readCollaboration(Request $request)
    {
        $collaboration = Collaboration::with('user.collaborations')->find($request->collaboration_id);
        $collaboration->update(['read_at' => now()]);

        return new CollaborationResource($collaboration);
    }

    public function approve(Collaboration $collaboration)
    {
        $collaboration->update(['approved_at' => now()]);

        return redirect()->route('homeworks.on-collaboration');
    }

    public function releasePayment(Collaboration $collaboration)
    {
        $collaboration->update(['payment_released_at' => now()]);

        // $collaboration->user->notify(new CollaborationRealesedPaymentNotification($collaboration->homework->title));

        return response()->json(['payment_released_at' => [
            'relative' => now()->diffForHumans(),
            'string' => now()->toDateTimeString(),
            'special' => now()->isoFormat('DD MMM, YYYY'),
        ]]);
    }

    public function payment(Collaboration $collaboration)
    {
        $collaboration = CollaborationResource::make(Collaboration::with('user', 'homework')->findOrFail($collaboration->id));
        $publicKey = config('services.stripe.key');

        return inertia('Collaborations/Payment', compact('collaboration', 'publicKey'));
    }

    public function paymentMethodCreate(Request $request)
    {
        // try {
        //     auth()->user()->charge($request->price * 100, $request->payment_method);
        //     $collaboration = Collaboration::find($request->collaboration_id);
        //     $collaboration->update(['approved_at' => now()]);
        //     $collaboration->user->notify(new ApprovedCollaborationNotification($collaboration->homework->title));
        //     return redirect()->route('homeworks.on-collaboration')->with('message', 'El pago se ha procesado correctamente!');
        // } catch (Exception $e) {
        //     return redirect()->route('homeworks.no-collaboration')->with('error', 'Ocurrió un error al procesar el pago. Puede ser por fondos insuficientes, CVC incorrecto, tarjeta caducada o número de la tarjeta incorrecto.');
        // }
    }

    public function storeBankData(Request $request)
    {
        $collaboration = Collaboration::find($request->collaboration_id);

        $validated = $request->validate([
            'bank_number' => 'required|numeric|digits:16',
            'bank_name' => 'required|string|max:50',
        ]);

        $collaboration->update($validated);

        // User::where('email', 'soporte@youpartner.xphere.com.mx')->first()->notify(new MakeDepositNotification($collaboration));

        return redirect()->route('collaborations.completed')
            ->with('message', 'Hemos recibido tus datos, se te enviará notificación cuando se realice el depósito (máx. 24 hrs)');
    }
    
    public function payed(Request $request)
    {
        $collaboration = Collaboration::find($request->collaboration_id);

        $collaboration->update(['payed_at' => now()]);

        // $collaboration->user->notify(new CollaborationPayedNotification($collaboration->homework->title));

        $data = [
            'user_name' => $collaboration->user->name,
            'homework_name' => $collaboration->homework->title,
            'file' => $request->file
        ];

        // Mail::to($collaboration->user->email)->bcc('miguelvz26.mv@gmail.com')->send(new ProofOfPaymentMailable($data));

        return redirect()->route('admin.collaborations')
            ->with('message', 'Se ha marcado como pagada la colaboración. No olvides corroborar que el correo se haya mandado correctamente');
    }
}
