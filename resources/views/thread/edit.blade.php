<x-app-layout>
  <div class="max-w-4xl  mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 mb-4">
        <div class="p-4">

          <h2 class="mb-4 flex font-semibold text-white/90">
              Editar Pregunta
          </h2>
          <form action="{{route('threads.update', $thread)}}" method="POST">
            @csrf
            @method('PUT')

            @include('thread.form')

            <input type="submit" value="Editar Pregunta" class="cursor-pointer w-full py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-bold text-xs rounded-md">
          </form>

          @if(isset($thread))
            <form id='delete-theard' action="{{route('threads.destroy', $thread)}}" method="POST" class="mt-5">
                @csrf
                @method('DELETE')
                <input type="submit"  value="Eliminar" class="cursor-pointer w-full py-4 bg-gradient-to-r from-red-600 to-red-700 hover:to-red-600 text-white/90 font-bold text-xs rounded-md">
                    <script>
                        document.querySelector('#delete-theard').addEventListener('submit', function(e) {
                            e.preventDefault();
                            Swal.fire({
                              title: "Estas seguro??",
                              text: "Esta accion no puede revertise",
                              icon: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#3085d6",
                              cancelButtonColor: "#d33",
                              confirmButtonText: "Si"
                            }).then((result) => {
                              if (result.isConfirmed) {
                                  document.querySelector('#delete-theard').submit();
                              }
                            });
                        });
                    </script>
            </form>
          @endif
        </div>
    </div>
  </div>
</x-app-layout>
