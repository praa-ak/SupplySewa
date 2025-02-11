<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supply Sewa</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<section class="h-screen bg-center bg-no-repeat bg-[url('https://www.thebusinessconcept.com/wp-content/uploads/2022/12/Supply-Chain-Logistics.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="flex justify-center gap-10 pt-10">

        <div class="max-w-sm bg-white border border-gray-200 opacity-70 hover:opacity-100 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="https://cdn-icons-png.flaticon.com/512/2821/2821742.png" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Manufacturer</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">A manufacturer is a company or entity that produces goods using raw materials, labor, and machinery.</p>
                <a href="{{route('filament.manufacturer.auth.login')}}" class="inline-flex items-center px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                   Login
                     <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="max-w-sm bg-white border border-gray-200 opacity-70 hover:opacity-100 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="https://png.pngtree.com/png-clipart/20201208/original/pngtree-order-checking-isomatric-infographic-vector-illustration-png-image_5579783.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Distributor</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">A distributor is an entity that purchases goods from manufacturers and sells them to retailers, wholesalers, or end consumers.</p>
                <a href="{{route('filament.distributor.auth.login')}}" class="inline-flex items-center  px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login
                     <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="max-w-sm bg-white border border-gray-200 opacity-70 hover:opacity-100 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="https://png.pngtree.com/png-clipart/20220621/original/pngtree-3d-building-bangunan-alfamart-shop-indonesia-png-vektor-transparent-background-png-image_8173439.png" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Retailer</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">A retailer is a business or individual that sells products directly to consumers for personal use.    </p>
                <a href="{{route('filament.retailer.auth.login')}}" class="inline-flex items-center  px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login
                     <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
