<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Quiz Form</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Oops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('quiz.fetchQuestions') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Number of Questions:</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" min="1" max="50" required>
        </div>

        <div class="mb-3">
            <label for="difficulty" class="form-label">Select Difficulty:</label>
            <select class="form-select" id="difficulty" name="difficulty" required>
                <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="medium" {{ old('difficulty') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Hard</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Select Type:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="multiple" {{ old('type') == 'any' ? 'selected' : '' }}>Any</option>
                <option value="multiple" {{ old('type') == 'multiple' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>True / False</option>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
