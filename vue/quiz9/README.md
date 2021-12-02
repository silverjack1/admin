# VueQuiz
A sample quiz application built with VueJs
![image](https://user-images.githubusercontent.com/14722744/31414889-0838c00e-ae18-11e7-88b8-410e83d2bd4d.png)

## Getting Started
VueQuiz accepts data as a json object in the following format.

```
//Quiz json object format
{
  "status": true,
  "data": {
    "quiz": {
      "Id": 1,
      "name": "Introduction Quiz",
      "description": ""
    },
    "config": {

      "time": 10,
      "is_timed": true,
      "score": "10.00"
    },
    "questions": [{
      "Id": 8,
      "Name": "What is your name?",
      "Options": [{
        "Id": 93,
        "QuestionId": 8,
        "Name": "My name is James",
        "IsAnswer": false
      }, {
        "Id": 94,
        "QuestionId": 8,
        "Name": "James the king is my name",
        "IsAnswer": true
      },
        {
          "Id": 95,
          "QuestionId": 8,
          "Name": "NIV",
          "IsAnswer": false
        }
      ],
      "Answered": []
    },
      {
        "Id": 9,
        "Name": "Where do I live?",
        "Options": [{
          "Id": 88,
          "QuestionId": 9,
          "Name": "I live in Ogede Igbo",
          "IsAnswer": false
        },
          {
            "Id": 89,
            "QuestionId": 9,
            "Name": "Ogede Igbo",
            "IsAnswer": true
          }
        ],
        "Answered": []
      }
    ]
  }
}
```

You can specify the data source for the quiz by changing the ```get_endpoint``` attribute  in  your ```index``` file.

```
<div class="row col-md-12" id="app" get_endpoint="http://example.com/get/quiz.json" post_endpoint="http://example.com/post/quiz/result">
<component :is="currentView" :quiz_details="quiz_details" transition="fade"
transition-mode="out-in"></component>
</div>
```

