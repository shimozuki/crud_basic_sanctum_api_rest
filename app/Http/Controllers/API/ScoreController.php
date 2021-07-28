<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Score;

class ScoreController extends Controller
{
    public function index()
    {
        return Score::all();
    }

    public function create(Request $request)
    {
        foreach ($request->list_pelajaran as $key => $value) {
            $score = array(
                'student_id' => $value['student_id'],
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai'],
                'guru' => $value['guru']
            );
            $scores = Score::create($score);
        }

        return response()->json([
                'message'       => 'success',
                'data_student'  => $score
            ], 200);
    }
    public function edit($id)
    {
        $student = Student::with('score')->where('id', $id)->first();
        return response()->json([
                'message'       => 'success',
                'data_student'  => $student
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $score = Score::find($id);

        foreach ($request->list_pelajaran as $key => $value) {
            $score->update([
            'student_id' => $value['student_id'],
            'mata_pelajaran' => $value['mata_pelajaran'],
            'nilai' => $value['nilai'],
            'guru' => $value['guru']

        ]);
        }
        return response()->json([
                'message'       => 'success',
                'data_student'  => $score
            ], 200);
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();

        return response()->json([
                'message'       => 'data student berhasil dihapus'
            ], 200);
    }
}
