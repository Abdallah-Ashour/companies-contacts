{{-- <tr @if ($loop->last || $loop->first)
    class="table-success"
@endif> --}}
<th scope="row">{{ $arr->firstItem() + $index}}</th>
<td>{{$contact['first_name'] }}</td>
<td> {{$contact['last_name']}}</td>
<td>{{$contact['phone']}}</td>
<td>{{$contact['email']}}</td>
<td>{{ $contact->company_id}}</td>
{{-- <td>{{ $contact->company->name}}</td> --}}
<td>
    @if ($showTrashButton)

    @include('shared.buttons.restore', [
        'action' => route('index.restore', $contact->id)
    ])

    @include('shared.buttons.force-delete', [
        'action' => route('index.force-delete', $contact->id)
    ])

    @else

            <a href="{{ route("index.show", $contact['id']) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
            <a href="{{ route('index.edit', $contact->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
            @include('shared.buttons.destroy', [
                'action' => route('index.destroy', $contact->id)
                ])

    @endif
</td>
</tr>
