<x-filament::page>
    <form wire:submit.prevent="simpan">
        {{ $this->form }}

        @if (!empty($studentsList))
            <div class="mt-6">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 border text-left">Nama Siswa</th>
                            <th class="px-3 py-2 border text-center">Masuk Kelas Ini?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentsList as $index => $siswa)
                            <tr>
                                <td class="px-3 py-2 border">{{ $siswa['name'] }}</td>
                                <td class="px-3 py-2 border text-center">
                                    <input type="checkbox" wire:model.defer="studentsList.{{ $index }}.checked">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <x-filament::button type="submit" class="mt-4">
                Simpan Rombel
            </x-filament::button>
        @endif
    </form>
</x-filament::page>
