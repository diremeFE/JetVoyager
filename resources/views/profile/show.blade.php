@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Encabezado -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Perfil de usuario - JetVoyager</h1>

        <div class="flex flex-wrap lg:flex-nowrap gap-6 w-full">
            <!-- Columna izquierda: Información del usuario -->
            <div class="bg-white w-full lg:w-1/3 p-6 rounded-lg shadow-lg">
                <div class="flex flex-col items-center">
                    <!-- Imagen de perfil -->
                    <img src="{{ asset('storage/images/avatar-default.png') }}" alt="Imagen de perfil" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-gray-300 mb-4">
                    
                    <!-- Nombre del usuario -->
                    <h2 class="font-semibold text-xl text-gray-700">{{ $user->name }}</h2>
                    
                    <!-- Información adicional -->
                    <p class="text-gray-500 text-sm mt-2">Miembro desde {{ $user->created_at->format('F Y') }}</p>
                </div>

                <!-- Botones de acciones -->
                <div class="mt-6 flex flex-col gap-4">
                    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-300">
                        Cambiar foto de perfil
                    </button>
                    <button class="w-full bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 focus:ring focus:ring-gray-300">
                        Actualizar preferencias
                    </button>
                </div>
            </div>

            <!-- Columna derecha: Formulario y datos -->
            <div class="bg-white w-full lg:w-2/3 p-6 rounded-lg shadow-lg">
                <!-- Sección de datos personales -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Datos personales</h2>
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Campo Nombre -->
                        <div class="flex flex-col">
                            <label for="name" class="text-sm font-medium text-gray-700">Nombre completo</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                   class="mt-1 p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 focus:outline-none"
                                   placeholder="Introduce tu nombre" required>
                        </div>

                        <!-- Campo Email -->
                        <div class="flex flex-col">
                            <label for="email" class="text-sm font-medium text-gray-700">Correo electrónico</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="mt-1 p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 focus:outline-none"
                                   placeholder="Introduce tu correo" required>
                        </div>

                        <!-- Botón Guardar -->
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-300">
                            Guardar cambios
                        </button>
                    </form>
                </div>

                <!-- Historial de billetes -->
                <div class="mt-10">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Historial de viajes</h2>
                    <p class="text-gray-600 text-sm mb-6">
                        Aquí puedes ver los detalles de tus vuelos reservados en JetVoyager.
                    </p>
                    
                    <div class="space-y-4">
                        <!-- Información futura: vuelos reservados -->
                    {{-- 
                        @forelse ($user->flights as $flight)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h3 class="text-lg font-medium text-gray-700">
                                    Vuelo {{ $flight->code }} - {{ $flight->destination }}
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    Fecha: {{ $flight->date->format('d M, Y') }} <br>
                                    Asiento: {{ $flight->seat }} <br>
                                    Clase: {{ $flight->class }}
                                </p>
                            </div>
                        @empty
                            <p class="text-gray-500">No tienes vuelos reservados aún.</p>
                        @endforelse
                        --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de seguridad -->
        <div class="mt-10 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Seguridad de la cuenta</h2>
            <p class="text-gray-600 text-sm mb-6">
                Protege tu cuenta configurando una contraseña segura y habilitando opciones de seguridad.
            </p>
            
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Cambiar contraseña -->
                <div class="flex-1 bg-gray-100 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Cambiar contraseña</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Actualiza tu contraseña regularmente para mantener tu cuenta segura.
                    </p>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-300">
                        Actualizar contraseña
                    </button>
                </div>

                <!-- Autenticación de dos factores -->
                <div class="flex-1 bg-gray-100 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Autenticación de dos factores</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Añade una capa extra de seguridad habilitando la autenticación en dos pasos.
                    </p>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-300">
                        Configurar 2FA
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
