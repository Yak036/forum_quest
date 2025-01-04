<x-app-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                  <div class="flex justify-between items-center mb-6">
                      <h2 class="text-2xl font-semibold text-yellow-600">
                          Editar tema
                      </h2>
                      <form id="delete-thread" action="{{ route('threads.destroy', $thread) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="button" 
                              class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200"
                              onclick="confirmDelete()">
                              Eliminar tema
                          </button>
                      </form>
                  </div>

                  <form action="{{ route('threads.update', $thread) }}" method="POST">
                      @csrf
                      @method('PUT')

                      @include('thread.form')

                      <div class="flex justify-end mt-6">
                          <button type="submit" 
                              class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors duration-200">
                              Actualizar tema
                          </button>
                      </div>
                  </form>

                  <script>
                      function confirmDelete() {
                          Swal.fire({
                              title: "¿Estás seguro?",
                              text: "Esta acción no puede revertirse",
                              icon: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#3085d6",
                              cancelButtonColor: "#d33",
                              confirmButtonText: "Sí"
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  document.querySelector('#delete-thread').submit();
                              }
                          });
                      }
                  </script>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
