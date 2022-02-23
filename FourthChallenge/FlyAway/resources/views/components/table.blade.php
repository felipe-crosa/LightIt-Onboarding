@props(['columns','data'])
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">

            <x-table_header :columns="$columns" />
            
            <tbody>
              
              @foreach ($data as $object)
                  <x-table_row :columns="$columns" :object="$object"/>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>