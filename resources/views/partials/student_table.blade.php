@if ($students->isEmpty())
    <p class='ps-3 pt-2'>No Student Available</p>
@else
    @foreach ($students as $student)
        <tr>
            <td><img class='rounded mx-auto d-block' width='70px' height='70px' src='{{ $student->photo_path }}'>
            </td>
            <td>{{ $student->student_name }}</td>
            <td>{{ $student->father_name }}</td>
            <td>{{ $student->mother_name }}</td>
            <td>{{ $student->id }}</td>
            <td>{{ $student->admission_no }}</td>
            <td>
                @if ($student->classEntity)
                    {{ $student->classEntity->class_name }}
                @endif
            </td>
            <td>
                @if ($student->sectionDetails)
                    {{ $student->sectionDetails->section_name }}
                @endif
            </td>
            <td>
                <div class='d-flex justify-content-center align-items-center'>
                    <div style="padding-right: 10px;">
                        <a href="{{ route('edit.student', $student->id) }}" class='btn btn-primary btn-fill edit-btn'>
                            <span class="mdi mdi-pencil"></span>
                        </a>
                    </div>
                    <a href="#" class='btn btn-danger btn-fill delete-btn' data-id='{{ $student->id }}'
                        data-bs-toggle="modal" data-bs-target="#delete-student">
                        <span class="mdi mdi-trash-can-outline"></span>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@endif
