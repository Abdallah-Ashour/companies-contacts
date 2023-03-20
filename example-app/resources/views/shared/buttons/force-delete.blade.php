<form action="{{ $action }}" method="post" class="d-inline" onsubmit=" return confirm('Your data will be removed permanently. Are You Sure?')">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-circle btn-outline-danger "  title="Delete permanenly" ><i class="fa fa-times"></i></button>
</form>
