<div class="relative mb-6 w-full">
    {{-- Heading --}}
    <flux:heading size="xl" level="1">{{ __('Donation') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage donation members') }}</flux:subheading>
    <flux:separator variant="subtle" class="my-6" />

    {{-- Control --}}
    <div class="flex w-full items-center justify-end gap-3 md:w-auto">

        <!-- Search -->
        <flux:input icon="magnifying-glass" placeholder="Search members" size="sm" wire:model.live.debounce.400ms="search" class="w-full" />

        {{-- Export button --}}
        <flux:button variant="primary" color="rose" size="sm" wire:click="exportPdf">
            Export
        </flux:button>

        <!-- Add button -->
        <flux:modal.trigger name="modals-tarikan">
            <flux:button variant="primary" color="blue" size="sm" wire:click="create">
                + Add
            </flux:button>
        </flux:modal.trigger>

    </div>

    {{-- Separator --}}
    <flux:separator variant="subtle" class="mt-6" />

    {{-- Table donations --}}
    <flux:table :paginate="$this->tarikans">
        <flux:table.columns>
            <flux:table.column>#</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'member_id'" :direction="$sortDirection" wire:click="sort('member_id')">
                Member
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'nominal'" :direction="$sortDirection" wire:click="sort('nominal')">
                Amount
            </flux:table.column>
            <flux:table.column>Notification</flux:table.column>
            <flux:table.column>Action</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @forelse ($this->tarikans as $row)
                <flux:table.row>
                    <flux:table.cell>
                        {{ ($this->tarikans->currentPage() - 1) * $this->tarikans->perPage() + $loop->iteration }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ ucwords($row->member->nama) }}
                    </flux:table.cell>
                    <flux:table.cell>
                        Rp {{ number_format($row->nominal, 0, ',', '.') }}
                    </flux:table.cell>
                    <flux:table.cell>
                        @php
                            $message = urlencode('Terima kasih kepada *' . ucwords($row->member->nama) . '* atas sumbangan jimpitan sebesar Rp ' . number_format($row->nominal, 0, ',', '.') . "\nDana yang terkumpul akan digunakan untuk kegiatan sosial di lingkungan RT 6 RW 1 Desa Sampang, Cilacap, Jawa Tengah\nSemoga menjadi amal baik untuk kita semua.\n\nAdapun kami sampaikan informasi jimpitan ini, bisa dilihat pada link berikut:\n ... \n\nHormat Kami\nKetua RT 6/I, Sampang, Cilacap\nttd\nAdi Kuncoro\n\n> update: " . $row->created_at->format('D, d M Y') . '');
                        @endphp
                        <flux:button size="sm" variant="primary" color="green" href="https://wa.me/{{ $row->member->whatsapp }}?text={{ $message }}" target="_blank">
                            Send wa
                        </flux:button>
                    </flux:table.cell>
                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:modal.trigger name="modals-tarikan">
                                <flux:button size="sm" variant="filled" wire:click="edit({{ $row->id }})">
                                    Edit
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:modal.trigger name="delete-tarikan">
                                <flux:button size="sm" variant="danger" wire:click="confirmDelete({{ $row->id }})">
                                    Delete
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4">
                        <div class="py-3 text-center text-zinc-500">
                            Data tidak ditemukan.
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal add and edit --}}
    <flux:modal name="modals-tarikan" class="md:w-96" x-on:close-modal.window="$flux.modal('modals-tarikan').close()">
        <div class="space-y-6">

            {{-- Heading modal --}}
            <div>
                <flux:heading size="lg">
                    {{ $editId ? 'Edit Tarikan' : 'Tambah Tarikan' }}
                </flux:heading>
                <flux:text class="mt-2">
                    Manage donation details.
                </flux:text>
            </div>

            {{-- Form input --}}
            <flux:select wire:model="member_id" label="Member">
                <option value="">Pilih Member</option>
                @foreach ($this->members as $member)
                    <option value="{{ $member->id }}">
                        {{ $member->nama }}
                    </option>
                @endforeach
            </flux:select>
            <flux:input wire:model="nominal" label="Nominal" type="number" />

            {{-- Control input --}}
            <div class="flex items-center gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" size="sm">
                        Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button wire:click="save" wire:loading.attr="disabled" variant="primary" color="blue" size="sm" class="w-full">
                    <span wire:loading.remove wire:target="save">
                        {{ $editId ? 'Update' : 'Save' }}
                    </span>
                    <span wire:loading wire:target="save">
                        Saving...
                    </span>
                </flux:button>
            </div>
        </div>
    </flux:modal>

    {{-- Modal delete --}}
    <flux:modal name="delete-tarikan" class="min-w-[22rem]" x-on:close-modal.window="$flux.modal('delete-tarikan').close()">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    Delete tarikan?
                </flux:heading>
                <flux:text class="mt-2">
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button variant="danger" wire:click="delete">
                    Delete
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
