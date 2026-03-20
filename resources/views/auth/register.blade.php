@extends('layouts.guest', ['title' => 'Registro — Cazadores de Gastos Fantasma: Del Megavatio al Hogar'])

@section('content')
<div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-water-50 via-white to-fresh-50/60">
    {{-- Textura tipo expediente (líneas de investigación) --}}
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 opacity-20"
        style="background-image:
            repeating-linear-gradient(90deg, rgba(0,168,232,0.20) 0px, rgba(0,168,232,0.20) 1px, transparent 1px, transparent 44px),
            repeating-linear-gradient(0deg, rgba(144,190,109,0.12) 0px, rgba(144,190,109,0.12) 1px, transparent 1px, transparent 44px);"
    ></div>
    {{-- Scanlines + cuadricula (modo game) --}}
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 opacity-20 mix-blend-multiply"
        style="background-image:
            repeating-linear-gradient(to bottom, rgba(2,6,23,0.28) 0px, rgba(2,6,23,0.28) 1px, transparent 1px, transparent 5px),
            radial-gradient(circle at 1px 1px, rgba(0,168,232,0.18) 1px, transparent 1px);
            background-size: 100% 100%, 24px 24px;"
    ></div>
    {{-- Formas orgánicas (agua) --}}
    <div class="pointer-events-none absolute -right-24 -top-20 h-72 w-72 rounded-full bg-water/20 blur-3xl sm:h-96 sm:w-96" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-32 -left-16 h-80 w-80 rounded-full bg-fresh/25 blur-3xl sm:h-[28rem] sm:w-[28rem]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute left-1/2 top-1/3 h-64 w-64 -translate-x-1/2 rounded-full bg-water/10 blur-3xl" aria-hidden="true"></div>

    {{-- Barrido de escaneo: solo capa de fondo (no sobre el expediente) --}}
    <div class="scan-sweep-bg" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto flex min-h-screen max-w-lg flex-col px-4 py-10 sm:px-6 sm:py-14 lg:max-w-xl detective-enter">
        {{-- Header --}}
        <header class="mb-8 text-center sm:mb-10">
            <div class="mx-auto mb-5 flex justify-center">
                <div class="logo-float flex h-24 w-24 flex-col items-center justify-center gap-1 rounded-2xl border border-water/20 bg-white/80 p-2 shadow-sm backdrop-blur-sm sm:h-28 sm:w-28">
                    <img
                        src="{{ asset('logos/sochagota.png') }}"
                        alt="Sochagota"
                        class="h-20 w-auto sm:h-20 object-contain"
                    />
                </div>
            </div>
            <div class="gamify-badge mx-auto mb-2 inline-flex items-center justify-center gap-2 rounded-full border border-water/20 bg-white/70 px-3 py-1 shadow-sm">
                <svg class="h-4 w-4 text-water" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M21 21l-4.2-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="text-[11px] font-semibold uppercase tracking-widest text-water/90">Expediente PUEAA</span>
            </div>
            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                <span class="block">Cazadores de Gastos Fantasma</span>
                <span class="block text-water">Del Megavatio al Hogar</span>
            </h1>
            <div class="mx-auto mt-4 max-w-[min(100%,28rem)] sm:mt-5 sm:max-w-xl">
                <img
                    src="{{ asset('logos/campana-cazadores-a.png') }}"
                    alt="Arte de la campaña Cazadores de Gastos Fantasma: Del Megavatio al Hogar"
                    class="w-full rounded-2xl border border-water/25 bg-white/50 object-contain shadow-xl shadow-water/15 ring-1 ring-black/5"
                    loading="lazy"
                    width="1200"
                    height="675"
                />
            </div>
            <p class="mt-2 text-base leading-relaxed text-slate-600 sm:text-lg">Detecta la pista: registra tu intención</p>
        </header>

        {{-- Formulario --}}
        <main class="flex-1">
            <div class="relative expediente-paper rounded-2xl border-2 border-dashed border-water/25 bg-white/90 p-6 font-mono shadow-xl shadow-water/5 backdrop-blur-sm sm:p-8">
                <div class="mb-6 flex flex-col gap-3 border-b border-water/20 pb-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-water/20 bg-water/10 text-water">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="1.8"/>
                                <path d="M21 21l-4.2-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-water">Registro de Pistas</h2>
                            <p class="text-xs text-slate-600">Completa el expediente para recibir instrucciones.</p>
                        </div>
                    </div>

                    <span class="inline-flex items-center justify-center rounded-full border border-water/20 bg-white/70 px-3 py-1 text-[11px] font-semibold uppercase tracking-widest text-water/90 shadow-sm">
                        Nivel 1
                    </span>
                </div>
                <form action="{{ route('registro.store') }}" method="post" class="space-y-6" novalidate>
                    @csrf

                    @if (session('status'))
                        <div class="rounded-xl border border-fresh/20 bg-fresh/10 px-4 py-3 text-sm text-slate-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <label for="full_name" class="mb-1.5 block text-sm font-medium text-slate-700">Nombre completo <span class="text-water">*</span></label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.5 6a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input
                                type="text"
                                name="full_name"
                                id="full_name"
                                value="{{ old('full_name') }}"
                                required
                                autocomplete="name"
                                class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-base text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-water focus:outline-none focus:ring-2 focus:ring-water/30"
                                placeholder="Tu nombre y apellido"
                            />
                        </div>
                        @error('full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cedula" class="mb-1.5 block text-sm font-medium text-slate-700">Cédula <span class="text-water">*</span></label>
                        <input
                            type="text"
                            name="cedula"
                            id="cedula"
                            inputmode="numeric"
                            pattern="[0-9]{6,10}"
                            maxlength="10"
                            value="{{ old('cedula') }}"
                            required
                            autocomplete="off"
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-water focus:outline-none focus:ring-2 focus:ring-water/30"
                            placeholder="Solo números"
                        />
                        @error('cedula')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Correo <span class="text-water">*</span></label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Zm0 4-8 5-8-5V6l8 5 8-5v2Z"/>
                                </svg>
                            </span>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-base text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-water focus:outline-none focus:ring-2 focus:ring-water/30"
                                placeholder="tucorreo@ejemplo.com"
                            />
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Datos del hogar (opcional) --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50/80 p-4 sm:p-5">
                        <h2 class="text-sm font-semibold text-slate-700">Datos del hogar <span class="font-normal text-slate-500">(opcional)</span></h2>
                        <p class="mt-1 text-xs text-slate-500">Nos ayuda a orientar mejor las recomendaciones de ahorro.</p>

                        <div class="mt-4 space-y-4">
                            <div>
                                <label for="household_size" class="mb-1.5 block text-sm font-medium text-slate-600">Número de personas en el hogar</label>
                                <input
                                    type="number"
                                    name="household_size"
                                    id="household_size"
                                    min="1"
                                    max="30"
                                    step="1"
                                    value="{{ old('household_size') }}"
                                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 shadow-sm focus:border-fresh focus:outline-none focus:ring-2 focus:ring-fresh/30"
                                    placeholder="Ej. 4"
                                />
                            </div>
                            <div>
                                <label for="age_range" class="mb-1.5 block text-sm font-medium text-slate-600">Rango de edad predominante</label>
                                <select
                                    name="age_range"
                                    id="age_range"
                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 shadow-sm focus:border-fresh focus:outline-none focus:ring-2 focus:ring-fresh/30"
                                >
                                    <option value="" @selected(old('age_range') === null || old('age_range') === '')>Selecciona…</option>
                                    <option value="ninos_jovenes" @selected(old('age_range') === 'ninos_jovenes')>Niños / Jóvenes</option>
                                    <option value="adultos" @selected(old('age_range') === 'adultos')>Adultos</option>
                                    <option value="adultos_mayores" @selected(old('age_range') === 'adultos_mayores')>Adultos mayores</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="group relative overflow-hidden w-full rounded-2xl bg-gradient-to-r from-water to-water-600 py-4 text-base font-semibold text-white shadow-lg shadow-water/25 transition duration-200 hover:scale-[1.02] hover:shadow-xl hover:shadow-water/30 active:scale-[0.98] sm:py-4 sm:text-lg"
                    >
                        <span
                            aria-hidden="true"
                            class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/35 to-transparent transition-transform duration-700 group-hover:translate-x-full"
                        ></span>

                        <span class="relative inline-flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M12 2l3.2 7.2L23 12l-7.8 2.8L12 22l-3.2-7.2L1 12l7.8-2.8L12 2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                            </svg>
                            ¡Empezar a Ahorrar!
                        </span>
                    </button>
                </form>
            </div>
        </main>

        {{-- Footer legal --}}
        <footer class="mt-10 text-center">
            <div class="mx-auto mb-3 flex max-w-md items-center justify-center gap-3">
                <img
                    src="{{ asset('logos/seguros-bolivar.svg') }}"
                    alt="Seguros Bolívar"
                    class="h-10 w-auto"
                />
            </div>

            <p class="mx-auto max-w-md text-xs leading-relaxed text-slate-500 sm:text-sm">
                Sochagota participa en el marco del Programa de Uso Eficiente y Ahorro de Agua (PUEAA). El tratamiento de datos personales se realiza conforme a la normativa colombiana aplicable.
            </p>
        </footer>
    </div>
</div>
@endsection
