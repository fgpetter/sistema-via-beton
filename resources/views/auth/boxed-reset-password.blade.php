@extends('layouts.base', ['title' => 'Reset Password'])

@section('css')

@endsection

@section('content')
    <div class="bg-cover bg-center bg-no-repeat bg-[url('/images/login-bg.jpg')] dark:bg-[url('/images/login-bg.jpg')] min-h-screen flex justify-center items-center">
        <div class="relative">
            <div class="bg-card/95 rounded-lg w-4/5 sm:w-2/3 mx-auto">
                <div class="grid lg:grid-cols-12 grid-cols-1 items-center gap-0">
                    <div class="lg:col-span-5">
                        <div class="text-center px-10 py-12">
                            <div class="mt-8">
                                <h4 class="mb-4 text-primary text-xl font-semibold">Esqueceu sua senha?</h4>
                            </div>
                            <div class="p-3 mb-6 text-warning rounded-md bg-warning/15">
                                Digite seu email, e instruções serão enviadas para você
                            </div>
                            <form action="/forgot-password" method="POST">
                                @csrf

                                <div class="text-start">
                                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="email">Email</label>
                                    <input class="form-input @error('email') border-danger @enderror" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Digite seu email" 
                                           type="email"
                                           value="{{ old('email') }}"
                                           required
                                           autofocus/>
                                    @error('email')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-8">
                                    <button class="btn bg-primary text-white w-full" type="submit">
                                        Enviar link de recuperação
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    <p class="text-base text-default-800">Votar para tela de login <a
                                            class="text-primary underline"
                                            href="/login"> Clique aqui </a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="lg:col-span-7 bg-card/60 mx-2 my-2 shadow-[0_14px_15px_-3px_#f1f5f9,0_4px_6px_-4px_#f1f5f9] dark:shadow-none rounded-lg">
                        <div class="pt-10 px-10 h-full">
                            <div class="mt-auto">
                                <img alt="Via Beton" src="{{ asset('images/logo-vb-hd.png') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
