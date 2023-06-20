<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="w-full md:w-1/2 py-24 mx-auto">
            <div class="mb-4">
                <h2 class="text-2xl font-medium text-gray-900 title-font">
                    Crear un empleado
                </h2>
            </div>
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-200 text-red-800">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('listings.job') }}" id="employee_form" method="post" enctype="multipart/form-data"
                class="bg-gray-100 p-4">
                @csrf
                @guest
                    <div class="flex mb-4">
                        <div class="flex-1 mx-2">
                            <x-label for="email" value="Correo Electrónico" />
                            <x-input class="block mt-1 w-full" id="email" type="email" name="email"
                                value="old('email')" required autofocus />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="clave" value="clave" />
                            <x-input class="block mt-1 w-full" id="clave" type="password" name="clave" value=""
                                required autofocus />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="nombre" value="Nombre" />
                            <x-input class="block mt-1 w-full" id="nombre" type="text" name="nombre"
                                value="old('name')" required />
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="flex-1 mx-2">
                            <x-label for="apellido" value="Apellido" />
                            <x-input class="block mt-1 w-full" id="apellido" type="text" name="apellido"
                                value="old('last name')" required />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="telefono" value="Teléfono" />
                            <x-input class="block mt-1 w-full" id="telefono" type="tel" name="telefono" required />
                        </div>
                    </div>
                @endguest
                <div class="mb-4 mx-2">
                    <x-label for="foto_perfil" value="Imágen del empleado" />
                    <x-input id="foto_perfil" class="block mt-1 w-full" type="file" name="foto_perfil" />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="direccion" value="Dirección" />
                    <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="ciudad" value="Ubicación (e.g. Remote, United States)" />
                    <x-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="estado" value="Estado (e.g. Remote, United States)" />
                    <x-input id="estado" class="block mt-1 w-full" type="text" name="estado" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="codigo_postal" value="Código postal" />
                    <x-input id="codigo_postal" class="block mt-1 w-full" type="number" name="codigo_postal"
                        required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="habilidades" value=" Tus habilidades" />
                    <x-input id="habilidades" class="block mt-1 w-full" type="text" name="habilidades" />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="experiencia_laboral" value="Experiencia de trabajo" />
                    <textarea id="experiencia_laboral" rows="12" type="text"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        name="experiencia_laboral"></textarea>
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="educacion" value="Educación" />
                    <textarea id="educacion" rows="12" type="text"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        name="educacion"></textarea>
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="resumen" value="Descripción de usted mismo" />
                    <textarea id="resumen" rows="12" type="text"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        name="resumen"></textarea>
                </div>
                <div class="mb-6 mx-2">
                    <div id="card-element"></div>
                </div>
                <div class="mb-2 mx-2">
                    @csrf
                    <input type="hidden" id="employee_method_id" name="employee_method_id" value="">
                    <button type="submit" id="form_submit"
                        class="block w-full items-center bg-indigo-500 text-white border-0 py-2 focus:outline-none hover:bg-indigo-600 rounded mb-2 text-base mt-4 md:mt-0">Sign-In</button>
                 <center>   <p>ya tienes una cuenta? ps...</p>
                    <a  id="form_submit"
                      href="{{route('login')}}"  class="block w-full items-center bg-indigo-500 text-white border-0 py-2 focus:outline-none hover:bg-indigo-600 rounded mb-2 text-base mt-4 md:mt-0">Log-In</button>
                    </a>
                </center>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </form>
        </div>
    </section>
</x-app-layout>
