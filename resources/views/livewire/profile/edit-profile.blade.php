<div>
    @if (session()->has('success'))
        <div class="mb-4 rounded-lg bg-success/10 p-4 text-sm text-success border border-success/20">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="save">
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-default-700 mb-1">Nome</label>
                <input
                    wire:model="name"
                    type="text"
                    id="name"
                    class="form-input w-full @error('name') border-danger @enderror"
                    placeholder="Nome completo"
                >
                @error('name')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-default-700 mb-1">E-mail</label>
                <input
                    wire:model="email"
                    type="email"
                    id="email"
                    class="form-input w-full @error('email') border-danger @enderror"
                    placeholder="email@exemplo.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-default-700 mb-1">
                    Nova Senha
                    <span class="text-default-400 font-normal">(deixe em branco para manter a atual)</span>
                </label>
                <input
                    wire:model="password"
                    type="password"
                    id="password"
                    class="form-input w-full @error('password') border-danger @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-default-700 mb-1">
                    Confirmar Nova Senha
                </label>
                <input
                    wire:model="password_confirmation"
                    type="password"
                    id="password_confirmation"
                    class="form-input w-full @error('password_confirmation') border-danger @enderror"
                    placeholder="••••••••"
                >
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-2 pt-4">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="btn bg-primary text-white hover:bg-primary/90"
                >
                    <span wire:loading.remove>Salvar Alterações</span>
                    <span wire:loading>Salvando...</span>
                </button>
            </div>
        </div>
    </form>
</div>
