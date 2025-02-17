<!-- @extends('layouts.app') -->

@section('content')
<div class="container">
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
    <form action="{{ route('contacts.importXML') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <input type="file" name="xml_file" required>
        <button type="submit" class="btn btn-success">Import XML</button>
    </form>

    @if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection