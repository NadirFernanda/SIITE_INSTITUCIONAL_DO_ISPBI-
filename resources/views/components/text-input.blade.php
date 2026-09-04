@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'auth-input border-gray-300 bg-white text-gray-900 placeholder-gray-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-400 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
