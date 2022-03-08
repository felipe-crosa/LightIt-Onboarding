@props(['href'])
<div class="relative flex justify-center items-center">
    <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
    
  
    <div id="menu" class="hidden w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
      <div class="2xl:container  2xl:mx-auto py-48 px-4 md:px-28 flex justify-center items-center rounded">
        <div class="w-96 md:w-auto dark:bg-gray-800 relative flex flex-col justify-center items-center bg-white py-16 px-4 md:px-24 xl:py-24 xl:px-36 rounded-xl">
          
          <div class="mt-12">
            <h1 role="main" class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-center text-gray-800">{{$slot}}</h1>
          </div>
          
          <a href="{{$href}}"><button class="rounded-xl w-full dark:text-gray-800 dark:hover:bg-gray-100 dark:bg-white sm:w-auto mt-14 text-base leading-4 text-center text-white py-6 px-16 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 hover:bg-black">{{$button}}</button></a>
          
          <button onclick="showMenu(true)" class="text-gray-800 dark:text-gray-400 absolute top-8 right-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800" aria-label="close">
            <x-cross-svg :size="24"/>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
  let menu = document.getElementById("menu");
  const showMenu = (flag) => {
    menu.classList.toggle("hidden");
  };
  </script>

