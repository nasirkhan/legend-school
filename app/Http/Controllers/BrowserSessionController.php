<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrowserSessionController extends Controller
{
    public function setYear(Request $request){
        if ($request->ajax()){
            if (Session::get('year')){
                Session::forget('year');
                Session::put('year',$request->year);
            }else{
                Session::put('year',$request->year);
            }
            return true;
        }
    }

    public function setSession(Request $request){
        if ($request->ajax()){
            if (Session::get('session_id')){
                Session::forget('session_id');
                Session::put('session_id',$request->session_id);
            }else{
                Session::put('session_id',$request->session_id);
            }
            return true;
        }
    }

    public function setSection(Request $request){
        if ($request->ajax()){
            if (Session::get('section_id')){
                Session::forget('section_id');
                Session::put('section_id',$request->section_id);
            }else{
                Session::put('section_id',$request->section_id);
            }
            return true;
        }
    }

    public function setClassId(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('class_id')){
                Session::forget('class_id');
                Session::put('class_id', $request->class_id);
            }else{
                Session::put('class_id', $request->class_id);
            }
            return true;
        }
    }

    public function setNextClassId(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('next_class_id')){
                Session::forget('next_class_id');
                Session::put('next_class_id', $request->next_class_id);
            }else{
                Session::put('next_class_id', $request->next_class_id);
            }
            return true;
        }
    }

    public function setNextYear(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('next_year')){
                Session::forget('next_year');
                Session::put('next_year', $request->next_year);
            }else{
                Session::put('next_year', $request->next_year);
            }
            return true;
        }
    }

    public function setSubjectId(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('subject_id')){
                Session::forget('subject_id');
                Session::put('subject_id', $request->subject_id);
            }else{
                Session::put('subject_id', $request->subject_id);
            }
            return true;
        }
    }

    public function setExamId(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('exam_id')){
                Session::forget('exam_id');
                Session::put('exam_id', $request->exam_id);
            }else{
                Session::put('exam_id', $request->exam_id);
            }
            return true;
        }
    }

    public function setUsedFor(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('used_for')){
                Session::forget('used_for');
                Session::put('used_for', $request->used_for);
            }else{
                Session::put('used_for', $request->used_for);
            }
            return true;
        }
    }

    public function setItemId(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('item_id')){
                Session::forget('item_id');
                Session::put('item_id', $request->item_id);
            }else{
                Session::put('item_id', $request->item_id);
            }
            return true;
        }
    }

    public function setMonthId(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('month_id')){
                Session::forget('month_id');
                Session::put('month_id', $request->month_id);
            }else{
                Session::put('month_id', $request->month_id);
            }
            return true;
        }
    }

    public function setBillingCycle(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('billing_cycle')){
                Session::forget('billing_cycle');
                Session::put('billing_cycle', $request->billing_cycle);
            }else{
                Session::put('billing_cycle', $request->billing_cycle);
            }
            return true;
        }
    }

    public function setFrom(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('from')){
                Session::forget('from');
                Session::put('from', $request->from);
            }else{
                Session::put('from', $request->from);
            }
            return true;
        }
    }

    public function setTo(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('to')){
                Session::forget('to');
                Session::put('to', $request->to);
            }else{
                Session::put('to', $request->to);
            }
            return true;
        }
    }

    public function setBeneficiaryTypeId(Request $request){
        if ($request->ajax()) {
            if (Session::get('beneficiary_type_id')){
                Session::forget('beneficiary_type_id');
                Session::put('beneficiary_type_id', $request->beneficiary_type_id);
            }else{
                Session::put('beneficiary_type_id', $request->beneficiary_type_id);
            }
            return true;
        }
    }

    public function setExpenseItemId(Request $request){
        if ($request->ajax()) {
            if (Session::get('expense_item_id')){
                Session::forget('expense_item_id');
                Session::put('expense_item_id', $request->expense_item_id);
            }else{
                Session::put('expense_item_id', $request->expense_item_id);
            }
            return true;
        }
    }

    public function setTransactionType(Request $request){
        if ($request->ajax()) {
            if (Session::get('transaction_type')){
                Session::forget('transaction_type');
                Session::put('transaction_type', $request->transaction_type);
            }else{
                Session::put('transaction_type', $request->transaction_type);
            }
            return true;
        }
    }
}
