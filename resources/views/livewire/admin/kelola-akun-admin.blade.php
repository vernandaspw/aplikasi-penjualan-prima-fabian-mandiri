<div>
    <livewire:admin.component.navbar-admin />

    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table ">
                <thead class="table-light">
                    <tr>
                        <th scope="col"  style="width: 5%">#</th>
                        <th scope="col"   style="width: 20%">Nama</th>
                        <th scope="col"  style="width: 20%">No HP</th>
                        <th scope="col"  style="width: 20%">Email</th>
                        <th scope="col"  style="width: 15%">Role</th>
                        <th scope="col" style="width: 15%">Status</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    @forelse ($akun as $data)
                        <tr>
                            <th scope="row">
                                {{ $loop->iteration }}
                            </th>
                            <td>{{ $data->nama }}</td>
                            <td>0{{ $data->nohp }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role }}</td>
                            <td>
                                <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    wire:click="ubahstatus({{ $data->id }})" type="button"
                                    class="btn btn-sm text-white rounded-pill px-4 {{ $data->isaktif == true ? 'btn-success' : 'btn-danger' }}">
                                    {{ $data->isaktif == true ? 'aktif' : 'tidak aktif' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        tidak ada data
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
