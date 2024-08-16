<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report for Project</title>
    <style>
        * {
  margin: 0;
  padding: 0;
  font-family: 'AvenirNext-Light', 'Avenir Next Light', 'Avenir Next', sans-serif;
}

@page {
  size: A4;
  @bottom-right {
    content: "Page " counter(page) " of " counter(pages);
  }
  @bottom-left {
    content: string(footerTitle);
  }
}

body {
  font-size: 80%;
  padding: 50px;
  background: #fff;
}

.header {
  width: 100%;
  font-size: 2em;
}

.printTable {
  width: 100%;
  min-width: 37em;
  border-collapse: collapse;
  font-size: 0.9em;
  font-weight: normal;
}

.printTable tr {
  height: 1em;
}

.printTable td {
  font-size: 0.8em;
  padding-top: 0.4em;
  padding-bottom: 0.4em;
  padding-left: 0.4em;
  padding-right: 0.4em;
  box-sizing: border-box;
  border-bottom: #ccc 0.125em solid;
}

.printTable .titleTr {
  font-size: 1.4em;
}

.printTable .titleTd {
  padding-bottom: 0;
  padding-left: 0px;
  padding-right: 0px;
  border: 0px solid;
}

.printTable .subtitleTr {
  font-size: 1.1em;
  border: 0px solid;
}

.printTable .headingTr {
  font-size: 0.9em;
  font-weight: 500;
  background: #d3ebfd;
}

.printTable .headingTd {
  border-bottom: #000 0.125em solid;
  border-top: #000 0.125em solid;
}

.printTable .sectionTr {
  background: #f6f3f7;
}

.printTable .sectionTd {
  font-weight: 500;
}

.printTable .col1 {
  width: 25%;
}

.printTable .col2 {
  width: 25%;
  text-align: right;
}

.printTable .col3 {
  text-align: right;
  width: 25%;
}

.printTable .col4 {
  text-align: right;
  width: 25%;
}

#task {
    list-style: none;
    padding: 0;
    margin: 0;
}
#subtask {
    list-style: none;
    padding: 0;
    margin: 0;
}
.right-align {display: -webkit-box; display: -webkit-flex; display: flex; justify-content: flex-end; -webkit-justify-content: flex-end; text-align:right;}
    </style>
</head>
<body>
    <div class="header">
        <p>Printable (and scalable) table for reports</p>
    </div>
      
      <table class="printTable">
        <tr class="titleTr">
          <td class="titleTd" colspan=2>Change body {font-size} to adjust scale</td>
          <td class="titleTd col4" colspan=2>Reporting Period</td>
        </tr>
        <tr class="subtitleTr">
          <td class="titleTd col1" colspan=2>{{ auth()->user()->name }}</td>
          <td class="titleTd col4" colspan=2>{{ now()->format('F j, Y') }}</td>
        </tr>
      
        <tr></tr>
      
        <tr class="headingTr">
          <td class="headingTd col1">DATE</td>
          <td class="headingTd col2">PROJECT</td>
          <td class="headingTd col3">TASK</td>
          <td class="headingTd col4">SUBTASK</td>
        </tr>

        <tr>
            <td class="col1">{{ $project->created_at->format('F j, Y') }}</td>
            <td class="col2">{{ $project->name }}</td>
                <td class="col3">
                    @foreach($project->tasks as $key => $task)
                        <li id="task">{{ $key + 1 }} . {{ $task->name }}</li>
                    @endforeach
                </td>
            <td class="col4">
              @foreach($project->tasks as $key => $task)
                  <ul>
                      @foreach($task->subtasks as $subkey => $subtask)
                          <li id="subtask">{{ $key + 1 }}.{{ $subkey + 1 }}. {{ $subtask->name }}</li>
                      @endforeach
                  </ul>
              @endforeach
            </td>
        </tr>
      </table>
</body>
</html>