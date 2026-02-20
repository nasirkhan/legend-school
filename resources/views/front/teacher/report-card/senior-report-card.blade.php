@extends('backend.exams.report-card.master')

@section('title'){{ $exam->name }} : {{ $student->name }}@endsection

@section('exam-name'){{ $exam->name }}@endsection

@section('session'){{ $exam->year }} - {{ $exam->year+1 }}@endsection

@section('teachers-evaluation')
    @include('backend.exams.report-card.includes.class-teacher-comments')
@endsection

@section('signature')
    @include('backend.exams.report-card.includes.signature')
@endsection
