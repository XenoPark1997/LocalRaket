<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class WorkspaceController extends Controller
{
    public function fileMaintenance(): View
    {
        return $this->section('File Maintenance');
    }

    public function profile(): View
    {
        return $this->section('Profile');
    }

    public function jobApplications(): View
    {
        return $this->section('Job Application');
    }

    public function jobPostings(): View
    {
        return $this->section('Job Posting');
    }

    public function settings(): View
    {
        return $this->section('Settings');
    }

    private function section(string $title): View
    {
        return view('workspace.section', compact('title'));
    }
}
