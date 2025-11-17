@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage Accommodation Forms</h1>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @php
        // Mock data for accommodation forms
        $accommodationForms = collect([
            (object) [
                'id' => 1,
                'student_name' => 'Ahmad bin Abdullah',
                'student_email' => 'ahmad.abdullah@student.ums.edu.my',
                'status' => 'pending',
                'submitted_date' => '2023-11-15',
                'documents' => ['declaration_form.pdf', 'id_card.pdf']
            ],
            (object) [
                'id' => 2,
                'student_name' => 'Nur binti Hassan',
                'student_email' => 'nur.hassan@student.ums.edu.my',
                'status' => 'approved',
                'submitted_date' => '2023-11-10',
                'documents' => ['request_form.pdf', 'proof_of_income.pdf']
            ],
            (object) [
                'id' => 3,
                'student_name' => 'Muhammad bin Ismail',
                'student_email' => 'muhammad.ismail@student.ums.edu.my',
                'status' => 'rejected',
                'submitted_date' => '2023-11-08',
                'documents' => ['declaration_form.pdf']
            ],
            (object) [
                'id' => 4,
                'student_name' => 'Siti binti Rahman',
                'student_email' => 'siti.rahman@student.ums.edu.my',
                'status' => 'pending',
                'submitted_date' => '2023-11-12',
                'documents' => ['request_form.pdf', 'id_card.pdf', 'transcript.pdf']
            ]
        ]);
    @endphp

    @if($accommodationForms->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documents</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($accommodationForms as $form)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $form->student_name }}</div>
                                <div class="text-sm text-gray-500">{{ $form->student_email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($form->status === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending Review</span>
                                @elseif($form->status === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($form->submitted_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ count($form->documents) }} file(s)
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($form->status === 'pending')
                                    <form method="POST" action="#" class="inline">
                                        @csrf
                                        <input type="hidden" name="form_id" value="{{ $form->id }}">
                                        <button type="submit" name="action" value="approve" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                    </form>
                                    <form method="POST" action="#" class="inline">
                                        @csrf
                                        <input type="hidden" name="form_id" value="{{ $form->id }}">
                                        <button type="submit" name="action" value="reject" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($form->status) }}</span>
                                @endif
                                <button class="text-blue-600 hover:text-blue-900 ml-2">View Details</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No accommodation forms found</h3>
            <p class="text-gray-600">There are currently no accommodation forms to manage.</p>
        </div>
    @endif
</div>
@endsection
