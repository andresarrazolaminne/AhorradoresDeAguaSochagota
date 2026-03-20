@extends('layouts.guest', ['title' => 'Inicio — Cazadores de Gastos Fantasma: Del Megavatio al Hogar'])

@section('content')
<div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-water-50 via-white to-fresh-50/60">
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 opacity-20"
        style="background-image:
            repeating-linear-gradient(90deg, rgba(0,168,232,0.20) 0px, rgba(0,168,232,0.20) 1px, transparent 1px, transparent 44px),
            repeating-linear-gradient(0deg, rgba(144,190,109,0.12) 0px, rgba(144,190,109,0.12) 1px, transparent 1px, transparent 44px);"
    ></div>
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 opacity-20 mix-blend-multiply"
        style="background-image:
            repeating-linear-gradient(to bottom, rgba(2,6,23,0.28) 0px, rgba(2,6,23,0.28) 1px, transparent 1px, transparent 5px),
            radial-gradient(circle at 1px 1px, rgba(0,168,232,0.18) 1px, transparent 1px);
            background-size: 100% 100%, 24px 24px;"
    ></div>
    <div class="pointer-events-none absolute -right-24 -top-20 h-72 w-72 rounded-full bg-water/20 blur-3xl sm:h-96 sm:w-96" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-32 -left-16 h-80 w-80 rounded-full bg-fresh/25 blur-3xl sm:h-[28rem] sm:w-[28rem]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute left-1/2 top-1/3 h-64 w-64 -translate-x-1/2 rounded-full bg-water/10 blur-3xl" aria-hidden="true"></div>

    <div class="scan-sweep-bg" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto flex min-h-screen max-w-lg flex-col px-4 py-10 sm:px-6 sm:py-14 lg:max-w-2xl detective-enter">
        <header class="mb-8 text-center sm:mb-10">
            <div class="mx-auto mb-5 flex justify-center">
                <div class="logo-float flex h-24 w-24 flex-col items-center justify-center gap-1 rounded-2xl border border-water/20 bg-white/80 p-2 shadow-sm backdrop-blur-sm sm:h-28 sm:w-28">
                    <img
                        src="{{ asset('logos/sochagota.png') }}"
                        alt="Sochagota"
                        class="h-20 w-auto object-contain sm:h-20"
                    />
                </div>
            </div>
            <div class="gamify-badge mx-auto mb-2 inline-flex items-center justify-center gap-2 rounded-full border border-water/20 bg-white/70 px-3 py-1 shadow-sm">
                <svg class="h-4 w-4 text-water" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M21 21l-4.2-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="text-[11px] font-semibold uppercase tracking-widest text-water/90">PUEAA · Sochagota</span>
            </div>
            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                <span class="block">Cazadores de Gastos Fantasma</span>
                <span class="block text-water">Del Megavatio al Hogar</span>
            </h1>
            {{-- Logo campaña: alternativas en public/logos — campana-cazadores-b.png, -c, -d --}}
            <div class="mx-auto mt-4 max-w-[min(100%,28rem)] sm:mt-6 sm:max-w-xl">
                <img
                    src="{{ asset('logos/campana-cazadores-a.png') }}"
                    alt="Campaña Cazadores de Gastos Fantasma: Del Megavatio al Hogar"
                    class="w-full rounded-2xl border border-water/25 bg-white/50 object-contain shadow-xl shadow-water/15 ring-1 ring-black/5"
                    loading="lazy"
                    width="1200"
                    height="675"
                />
            </div>
            <p class="mt-3 text-base leading-relaxed text-slate-600 sm:text-lg">
                Únete al cambio por nuestro recurso vital. Registra tu intención y recibe las pistas para cazar fugas en el hogar.
            </p>
        </header>

        <main class="flex flex-1 flex-col justify-center">
            <div class="relative rounded-2xl border-2 border-dashed border-water/25 bg-white/90 p-6 shadow-xl shadow-water/5 backdrop-blur-sm sm:p-8">
                <p class="text-center font-mono text-sm text-slate-600 sm:text-base">
                    Misión disponible: dejar constancia de participación en el reto de eficiencia hídrica.
                </p>
                <a
                    href="{{ route('registro.create') }}"
                    class="group relative mt-6 flex w-full items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-r from-water to-water-600 py-4 text-base font-semibold text-white shadow-lg shadow-water/25 transition duration-200 hover:scale-[1.02] hover:shadow-xl hover:shadow-water/30 active:scale-[0.98] sm:text-lg"
                >
                    <span
                        aria-hidden="true"
                        class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/35 to-transparent transition-transform duration-700 group-hover:translate-x-full"
                    ></span>
                    <span class="relative inline-flex items-center justify-center gap-2">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 2l3.2 7.2L23 12l-7.8 2.8L12 22l-3.2-7.2L1 12l7.8-2.8L12 2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                        </svg>
                        Ir al registro
                    </span>
                </a>
            </div>
        </main>

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
