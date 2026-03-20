@extends('layouts.guest', ['title' => 'Expectativa — Cazadores de Gastos Fantasma: Del Megavatio al Hogar'])

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
        </header>

        {{-- Contenido --}}
        <main class="flex-1">
            <div class="relative expediente-paper rounded-2xl border-2 border-dashed border-water/25 bg-white/90 p-6 font-mono shadow-xl shadow-water/5 backdrop-blur-sm sm:p-8">
                <div class="mb-6 flex flex-col gap-3 border-b border-water/20 pb-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-water/20 bg-water/10 text-water">
                            {{-- Ícono objetivo para Progreso --}}
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M12 12h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-water">Pista en proceso</h2>
                            <p class="text-xs text-slate-600">Tu expediente avanza paso a paso.</p>
                        </div>
                    </div>

                    <span class="inline-flex items-center justify-center rounded-full border border-water/20 bg-white/70 px-3 py-1 text-[11px] font-semibold uppercase tracking-widest text-water/90 shadow-sm">
                        Completado
                    </span>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-water/10 text-water">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22Z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M7.5 12.5L10.4 15.2L16.5 8.8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-slate-900">¡Tu intención quedó registrada!</h2>
                        <p class="mt-2 rounded-xl border border-water/35 bg-water/10 px-4 py-3 text-sm leading-relaxed text-slate-700 shadow-sm shadow-water/15">
                            <span class="font-semibold text-water">
                                Ya estás dentro
                            </span>
                            <span>
                                del equipo de Cazadores de Gastos Fantasma: Del Megavatio al Hogar.
                            </span>
                            <span class="font-semibold text-slate-900">
                                Pronto recibirás instrucciones.
                            </span>
                        </p>

                        <div class="mt-5">
                            <ol class="grid grid-cols-3 gap-2 text-center">
                                <li class="flex flex-col items-center">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full border border-water/45 bg-water/20 text-water font-semibold animate-pulse shadow-[0_0_0_4px_rgba(0,168,232,0.12)]">1</div>
                                    <span class="mt-2 text-[11px] font-semibold text-slate-600">Recibido</span>
                                </li>
                                <li class="flex flex-col items-center">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-400 font-semibold">2</div>
                                    <span class="mt-2 text-[11px] font-semibold text-slate-500">Verificando</span>
                                </li>
                                <li class="flex flex-col items-center">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-400 font-semibold">3</div>
                                    <span class="mt-2 text-[11px] font-semibold text-slate-500">Instrucciones</span>
                                </li>
                            </ol>

                            <div class="mt-3 h-2 rounded-full bg-water/10">
                                <div class="h-2 w-1/3 rounded-full bg-water"></div>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="mt-4 rounded-xl border border-fresh/20 bg-fresh/10 px-4 py-3 text-sm text-slate-700">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    <a
                        href="{{ route('registro.create') }}"
                        class="group relative inline-flex items-center justify-center overflow-hidden rounded-2xl border border-water/20 bg-white px-4 py-3 text-sm font-semibold text-water shadow-sm transition hover:-translate-y-[1px] hover:shadow-md hover:ring-2 hover:ring-water/20"
                    >
                        <span
                            aria-hidden="true"
                            class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-water/25 to-transparent transition-transform duration-700 group-hover:translate-x-full"
                        ></span>
                        <span class="relative">Registrar otra intención</span>
                    </a>
                    <a
                        href="{{ url('/') }}"
                        class="group relative inline-flex items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-r from-water to-water-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-water/25 transition hover:scale-[1.01] hover:ring-2 hover:ring-water/20"
                    >
                        <span
                            aria-hidden="true"
                            class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent transition-transform duration-700 group-hover:translate-x-full"
                        ></span>
                        <span class="relative">Volver al inicio</span>
                    </a>
                </div>
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

