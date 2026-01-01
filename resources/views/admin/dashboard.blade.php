<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stats Card 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-indigo-50 text-indigo-600 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <div class="text-slate-500 text-sm font-medium mb-1">Total Products</div>
            <div class="text-2xl font-bold text-slate-900">{{ \App\Models\Product::count() }}</div>
        </div>

        <!-- Stats Card 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-purple-50 text-purple-600 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">+5%</span>
            </div>
            <div class="text-slate-500 text-sm font-medium mb-1">Total Categories</div>
            <div class="text-2xl font-bold text-slate-900">{{ \App\Models\Category::count() }}</div>
        </div>

        <!-- Stats Card 3 (Placeholder) -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-50 text-blue-600 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-slate-500 bg-slate-50 px-2 py-1 rounded-lg">0%</span>
            </div>
            <div class="text-slate-500 text-sm font-medium mb-1">Registered Users</div>
            <div class="text-2xl font-bold text-slate-900">{{ \App\Models\User::count() }}</div>
        </div>

        <!-- Stats Card 4 (Placeholder) -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-orange-50 text-orange-600 p-3 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-slate-500 bg-slate-50 px-2 py-1 rounded-lg">0%</span>
            </div>
            <div class="text-slate-500 text-sm font-medium mb-1">Total Orders</div>
            <div class="text-2xl font-bold text-slate-900">0</div>
        </div>
    </div>

    <!-- Quick Actions / Recent Items -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="font-bold text-lg text-slate-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition-colors group">
                    <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full mb-3 group-hover:bg-indigo-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-indigo-700">Add Product</span>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-purple-500 hover:bg-purple-50 transition-colors group">
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full mb-3 group-hover:bg-purple-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-purple-700">Add Category</span>
                </a>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-center text-slate-400">
            Chart / Analytics Placeholder
        </div>
    </div>
</x-admin-layout>
