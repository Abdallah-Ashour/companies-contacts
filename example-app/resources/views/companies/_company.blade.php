{{-- <tr @if ($loop->last || $loop->first)
    class="table-success"
@endif> --}}
<th scope="row">{{ $companies->firstItem() + $index}}</th>
<td>{{$company['name'] }}</td>
<td>{{$company['website']}}</td>
<td>{{$company['email']}}</td>
<td><a href="{{route('index.index', ['company_id' => $company->id])}}">{{ $company->contact_count}}</a></td>
{{-- <td>{{ $company->company->name}}</td> --}}
<td>
    @if ($showTrashButton)

    @include('shared.buttons.restore', [
        'action' => route('companies.restore', $company->id)
    ])

    @include('shared.buttons.force-delete', [
        'action' => route('companies.force-delete', $company->id)
    ])


    @else

            <a href="{{ route("companies.show", $company['id']) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
            <a href="{{ route('companies.edit', $company->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>

            @include('shared.buttons.destroy', [
                'action' => route("companies.destroy", $company->id)
            ])

    @endif
</td>
</tr>
