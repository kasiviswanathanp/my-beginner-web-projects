<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function learningPath(Request $request)
    {
        $goal = $request->input('learning_goal', 'Learn a new subject');

        return response()->json([
            'success' => true,
            'message' => 'Personal learning path generated successfully.',
            'learning_path' => [
                [
                    'stage' => 1,
                    'title' => 'Foundation',
                    'description' => "Learn the basic concepts required for $goal.",
                    'progress' => 0
                ],
                [
                    'stage' => 2,
                    'title' => 'Core Concepts',
                    'description' => "Understand the important concepts of $goal in simple language.",
                    'progress' => 0
                ],
                [
                    'stage' => 3,
                    'title' => 'Practice',
                    'description' => 'Solve beginner exercises and practical problems.',
                    'progress' => 0
                ],
                [
                    'stage' => 4,
                    'title' => 'Mini Project',
                    'description' => "Build a small project related to $goal.",
                    'progress' => 0
                ],
                [
                    'stage' => 5,
                    'title' => 'Revision & Assessment',
                    'description' => 'Revise everything and test your understanding.',
                    'progress' => 0
                ]
            ]
        ]);
    }

    public function tasks()
    {
        return response()->json([
            'success' => true,
            'tasks' => [
                [
                    'id' => 1,
                    'title' => 'Learn one core concept',
                    'duration' => 30,
                    'completed' => false
                ],
                [
                    'id' => 2,
                    'title' => 'Practice 5 questions',
                    'duration' => 30,
                    'completed' => false
                ],
                [
                    'id' => 3,
                    'title' => 'Write short notes',
                    'duration' => 20,
                    'completed' => false
                ]
            ]
        ]);
    }

    public function chat(Request $request)
    {
        $message = $request->input('message', '');

        return response()->json([
            'success' => true,
            'reply' => "I understand your question: \"$message\". Let us break it into simple steps and learn it together."
        ]);
    }

    public function progress()
    {
        return response()->json([
            'success' => true,
            'progress' => [
                'current_level' => 25,
                'behaviour' => 80,
                'body_health' => 75,
                'emotional' => 85,
                'task_1' => 100,
                'task_2' => 50,
                'task_3' => 0,
                'addiction' => 20
            ]
        ]);
    }
}
