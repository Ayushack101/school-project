@if ($subjects->isEmpty())
    <p class='ps-3 pt-2'>No Subject Available</p>
@else
    @foreach ($subjects as $subject)
        <tr>
            <td>{{ $subject->subject_name }}</td>
            <td>{{ $subject->total_marks }}</td>
            <td>
                @if ($subject->teacher)
                    {{ $subject->teacher->first_name }} {{ $subject->teacher->last_name }}
                @endif
            </td>
            <td>
                <div class='d-flex justify-content-center align-items-center'>
                    <div style="padding-right: 10px;">
                        <a href="#" class='btn btn-primary btn-fill edit-btn' data-bs-toggle="modal"
                            data-bs-target="#edit-subject" data-id='{{ $subject->id }}'
                            data-total-marks='{{ $subject->total_marks }}'
                            data-subject-name='{{ $subject->subject_name }}' data-teacher='{{ $subject->teacher_id }}'>
                            <span class="mdi mdi-pencil"></span>
                        </a>
                    </div>
                    <a href="#" class='btn btn-danger btn-fill delete-btn' data-id='{{ $subject->id }}'
                        data-bs-toggle="modal" data-bs-target="#delete-subject">
                        <span class="mdi mdi-trash-can-outline"></span>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@endif
