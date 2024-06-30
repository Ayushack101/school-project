@if ($marksheets->isEmpty())
    <p class='ps-3 pt-2'>No Marksheet Available</p>
@else
    @foreach ($marksheets as $marksheet)
        <tr>
            <td>{{ $marksheet->marksheet_name }}</td>
            <td>{{ \Carbon\Carbon::parse($marksheet->exam_date)->format('d M Y') }}</td>
            <td>
                <div class='d-flex justify-content-center align-items-center'>
                    <div style="padding-right: 10px;">
                        <a href="#" class='btn btn-primary btn-fill edit-btn' data-bs-toggle="modal"
                            data-bs-target="#edit-marksheet" data-id='{{ $marksheet->id }}'
                            data-exam-date='{{ $marksheet->exam_date }}'
                            data-marksheet-name='{{ $marksheet->marksheet_name }}'>
                            <span class="mdi mdi-pencil"></span>
                        </a>
                    </div>
                    <a href="#" class='btn btn-danger btn-fill delete-btn' data-id='{{ $marksheet->id }}'
                        data-bs-toggle="modal" data-bs-target="#delete-marksheet">
                        <span class="mdi mdi-trash-can-outline"></span>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@endif
