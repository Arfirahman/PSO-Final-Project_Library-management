<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - Book Borrowing</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Select2 CSS for searchable select -->
    <!-- To disable Search Book feature for CI/CD, comment from here -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- To here -->
    <style>
        /* Custom style to make Select2 look like Tailwind input */
        .select2-container--default .select2-selection--single {
            background-color: #f9fafb; /* Tailwind's bg-gray-100 */
            border: 1px solid #d1d5db; /* Tailwind's border-gray-300 */
            border-radius: 0.375rem; /* Tailwind's rounded */
            padding: 0.5rem 0.75rem; /* Tailwind's py-2 px-3 */
            height: 2.5rem; /* Tailwind's h-10 */
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: #374151; /* Tailwind's text-gray-700 */
            box-shadow: none;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #374151; /* Tailwind's text-gray-700 */
            line-height: 2rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 2.5rem;
            right: 0.75rem;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #2563eb; /* Tailwind's focus:border-blue-600 */
            outline: none;
        }
        .select2-dropdown {
            border-radius: 0.375rem;
            border-color: #d1d5db;
        }
    </style>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .card {
            background-color: white;
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(255, 58, 58, 0.06); /* shadow-md */
            padding: 1.5rem; /* p-6 */
        }
        .gradient-button {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
            --tw-gradient-stops: #3b82f6, #8b5cf6; /* from-blue-500 to-purple-600 */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center space-x-2">
                <!-- User Icon (for header) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round text-blue-600">
                    <circle cx="12" cy="8" r="5"/><path d="M2 21a8 8 0 0 1 16 0"/>
                </svg>
                <span>User Dashboard</span>
            </h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Logout</button>
            </form>
        </div>

        <div class="mb-6 bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center space-x-3 mb-2">
                <!-- Hello User Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smile text-purple-600">
                    <circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800">Welcome!</h2>
            </div>
            <p class="text-lg text-gray-600">
                {{ $loggedInUser->name ?? 'User' }} ({{ $loggedInUser->email ?? 'N/A' }})
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column: Book Borrowing Form -->
            <div class="card">
                <div class="flex items-center space-x-3 mb-4">
                    <!-- Book Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-check text-blue-600">
                        <path d="M8 2h4a2 2 0 0 1 2 2v12a2 2 0 0 0 2 2h4"/><path d="M4 19.5c.32.7.74 1.35 1.22 1.94A6.74 6.74 0 0 0 12 22c2.5 0 5-1.28 6.74-3.86a6.74 6.74 0 0 0 1.22-1.93"/><path d="M2 19.5a6.74 6.74 0 0 1 8.24-4.8"/><path d="m16 11 2 2 4-4"/>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-800">Book Borrowing Form</h2>
                </div>
                <p class="text-gray-600 mb-6">Select the book you wish to borrow.</p>

                <form action="{{ route('user.borrow.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User Name:</label>
                        {{-- This will show the logged in user's name and email, and they can't change it --}}
                        <input type="text" id="user_name_display" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200" value="{{ $loggedInUser->name ?? 'User Not Found' }} ({{ $loggedInUser->email ?? 'N/A' }})" disabled>
                        <input type="hidden" name="user_id" value="{{ $loggedInUser->id ?? '' }}">
                        @error('user_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="book_id" class="block text-gray-700 text-sm font-bold mb-2">Book Title:</label>
                        <!--
                            We use Select2 JS library to make this dropdown searchable.
                            This helps users quickly find a book by typing its title or author.
                            To disable Search Book feature for CI/CD, comment from here (select2-related):
                        -->
                            <!--
                                OLD: Initial dropdown (not searchable, plain HTML select)
                                To compare, comment/uncomment this block.
                            -->
                            <!-- Initial Dropdown Start -->
                            <!-- <select name="book_id" id="book_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_id') border-red-500 @enderror" required>
                                <option value="">Select a Book</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} - {{ $book->author }} (Available: {{ $book->available }})
                                    </option>
                                @endforeach
                            </select> -->
                            <!-- Initial Dropdown End -->
                            <!--                             
                                NEW: Searchable dropdown using Select2 JS library
                                This helps users quickly find a book by typing its title or author.
                                To disable Search Book feature for CI/CD, comment from here (select2-related):
                            -->
                            <select name="book_id" id="book_id" class="w-full @error('book_id') border-red-500 @enderror" required>
                                <option value="">Select a Book</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} - {{ $book->author }} (Available: {{ $book->available }})
                                    </option>
                                @endforeach
                            </select>
                            <!-- To here -->
                        <!-- To here -->
                        @error('book_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="borrow_date" class="block text-gray-700 text-sm font-bold mb-2">Borrow Date:</label>
                        <input type="date" name="borrow_date" id="borrow_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('borrow_date') border-red-500 @enderror" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
                        @error('borrow_date')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="gradient-button text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline hover:opacity-90 transition-opacity">Borrow Book</button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Borrowing History -->
            <div class="card">
                <div class="flex items-center space-x-3 mb-4">
                    <!-- History Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history text-purple-600">
                        <path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-800">Borrowing History</h2>
                </div>
                <p class="text-gray-600 mb-6">List of books you have borrowed.</p>

                @if($borrowingHistory->isEmpty())
                    <p class="text-gray-600">You haven't borrowed any books yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($borrowingHistory as $borrow)
                            <div class="flex items-start space-x-3 p-3 rounded-lg bg-gray-50 border border-gray-200">
                                @if($borrow->return_date === null)
                                    <!-- Clock Icon for "Currently Borrowed" -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock text-blue-500 mt-1">
                                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                @else
                                    <!-- Check Circle Icon for "Returned" -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle text-green-500 mt-1">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>
                                    </svg>
                                @endif
                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800">{{ $borrow->book->title ?? 'Title Not Found' }}</p>
                                    <p class="text-sm text-gray-600">Borrowed: {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') }}
                                        @if($borrow->return_date === null)
                                            <span class="text-red-500 ml-2"> • Due date: {{ \Carbon\Carbon::parse($borrow->borrow_date)->addDays(7)->format('d/m/Y') }}</span>
                                        @else
                                            • Returned: {{ \Carbon\Carbon::parse($borrow->return_date)->format('d/m/Y') }}
                                        @endif
                                    </p>
                                </div>
                                <div class="text-sm font-medium whitespace-nowrap flex flex-col items-end gap-2">
                                    @if($borrow->return_date === null)
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full mb-1">Currently Borrowed</span>
                                        <!-- To disable Return Book feature for CI/CD, comment from here -->
                                        <form action="{{ route('user.borrow.return', $borrow->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to return this book?');">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">Return Book</button>
                                        </form>
                                        <!-- To here -->
                                    @else
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">Returned</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- To disable Search Book feature for CI/CD, comment from here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom JS for dashboard (optional, for further customizations) -->
    <script src="/js/user-dashboard.js"></script>
    <script>
        // Initialize Select2 on the book select dropdown
        // This makes the dropdown searchable and more user-friendly
        $(document).ready(function() {
            $('#book_id').select2({
                placeholder: 'Select a Book',
                allowClear: true,
                width: '100%' // Make sure it fits the parent width
            });
            // Add Tailwind classes to Select2 container for consistent style
            $('#book_id').on('select2:open', function() {
                $('.select2-dropdown').addClass('bg-white');
            });
        });
    </script>
    <!-- To here -->
</body>
</html>
