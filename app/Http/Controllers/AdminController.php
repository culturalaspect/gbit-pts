<?php

namespace App\Http\Controllers;

use App\Exports\DownloadExcelWithMinLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Excel;

use App\Models\Institution;
use App\Models\StudentsExam;
use App\Models\Student;
use App\Models\Semester;
use App\Models\StudentsSubject;
use App\Models\StudentsSemester;
use App\Models\StudentsFee;
use App\Models\StudentsFeesSelection;


class AdminController extends Controller
{
    protected $page_title = "Directorate of Education Colleges GB | Admin";
    protected $main_title = "Dashboard";
    protected $breadcrumb_title = "Dashboard";
    protected $selected_main_menu = "admin_dashboard";
    protected $card_title;
    protected $selected_sub_menu;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->selected_sub_menu = "admin_dashboard";
        $this->card_title = "Admin Dashboard";

        //return view('admin.dashboard')
        return view('layouts.main')
            ->with('main_title', $this->main_title)
            ->with('selected_main_menu', $this->selected_main_menu)
            ->with('breadcrumb_title', $this->breadcrumb_title)
            ->with('card_title', $this->card_title)
            ->with('selected_sub_menu', $this->selected_sub_menu)
            ->with('page_title', $this->page_title);
    }

}
