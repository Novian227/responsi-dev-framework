@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('tags.create') }}" class="btn btn-success">Tambah Merk</a>
</div>
<div class="card card-default">
    <div class="card-header">List Merk</div>
    <div class="card-body">
        @if ($tags->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <th>Nama Merk</th>
                <th>Jumlah produk yg memakai merk ini</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>
                            {{ $tag->name }}
                        </td>
                        <td>
                            {{ $tag->post->count() }}
                        </td>
                        <td class="float-right">
                            <a href="{{ route('tags.edit', $tag->id) }}"
                                class="btn btn-info btn-sm">
                                Edit</a>
                            <button class="btn btn-danger btn-sm"
                                onclick="handleDelete({{ $tag->id }})">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="diaf" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <form action="" method="POST" id="deletetagForm">
              @csrf
              @method('DELETE')
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Yakin mau menghapus merk ini ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @else 
        <h3 class="text-center">No tags yet</h3>
        @endif
    </div>
    @endsection

    @section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deletetagForm')
            form.action = '/tags/' + id
            $('#deleteModal').modal('show')
        }

    </script>
    @endsection
