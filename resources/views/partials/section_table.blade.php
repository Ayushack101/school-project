@if ($sections->isEmpty())
    <p class='ps-3 pt-2'>No Section Available</p>
@else
    @foreach ($sections as $section)
        <tr>
            <td>{{ $section->section_name }}</td>
            <td>
                @if ($section->teacher)
                    {{ $section->teacher->first_name }} {{ $section->teacher->last_name }}
                @endif
            </td>
            <td>
                <div class='d-flex justify-content-center align-items-center'>
                    <div style="padding-right: 10px;">
                        <a href="#" class='btn btn-primary btn-fill edit-btn' data-bs-toggle="modal"
                            data-bs-target="#edit-section" data-id='{{ $section->id }}'
                            data-section-name='{{ $section->section_name }}' data-teacher='{{ $section->teacher_id }}'>
                            <span class="mdi mdi-pencil"></span>
                        </a>
                    </div>
                    <a href="#" class='btn btn-danger btn-fill delete-btn' data-id='{{ $section->id }}'
                        data-bs-toggle="modal" data-bs-target="#delete-section">
                        <span class="mdi mdi-trash-can-outline"></span>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@endif
