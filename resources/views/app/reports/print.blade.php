<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@lang('Print'): {{ $report->name }}</title>

    <style>
      html {
        font-family: monospace;
        -webkit-font-smoothing: antialiased;
      }
      .card {
        background-color: #dedede !important;
        -webkit-print-color-adjust: exact;
        padding: 30px 20px;
        margin-bottom: 20px;
      }
      .table {
        width: 100%;
        text-align: left;
      }
      .table th {
        background: #dedede;
        padding: 10px 5px;
        font-size: 10px;
      }
      .table td {
        padding: 7px 5px;
        font-size: 9px;
      }
      tr:nth-child(even) {
          background-color: #f7f7f7;
      }
      .title {
        margin: 4px 0px;
      }
      .tag {
        margin: 0;
        background: #86af49;
        font-size: 10px;
        /* position: absolute; */
        padding: 3px 10px;
        border-radius: 10%;
      }
      .header_text {
        margin-bottom: 5px;
        font-size: 10px;
      }
      .header_text_right {
        float: right;
      }
      .report_meta {
        font-size: 8px;
        margin: 0px;
      }
    </style>
  </head>
  <body>

    <div class="header_text">
      <span class="header_text_left">@lang('Created At'): {{ $report->created_at->format('d/m/y h:i:s') }}</span>
      <span class="header_text_right">@lang('Printed At'): {{ now()->format('d/m/y h:i:s') }}</span>
    </div>

    <div class="card">
      <h3 class="title">{{ $report->name }}</h3>
      <p class="report_meta">@lang('Created By'): {{ $report->createdBy->name }}</p>
      <p class="report_meta">@lang('Printed By'): {{ Auth::user()->name }}</p>
    </div>

    <table class="table">
      <tr>
        <th>Name</th>
        <th>Make</th>
        <th>Description</th>
        <th>Category</th>
        <th>Serial</th>
        <th>Cost</th>
        <th>Room</th>
        <th>Building</th>
        <th>Missing</th>
        <th>Write Off</th>
      </tr>

      @foreach ($report->formattedData as $key => $data)
        <tr>
          <td>{{ $data['name'] ?? null }}</td>
          <td>{{ $data['make']['name'] ?? null }}</td>
          <td>{{ $data['description'] ?? null }}</td>
          <td>{{ $data['item_category']['name'] ?? null }}</td>
          <td>{{ $data['serial_number'] ?? null }}</td>
          <td>{{ $data['purchase_price'] ?? null }}</td>
          <td>{{ $data['room']['name'] ?? null }}</td>
          <td>{{ $data['room']['building']['name'] ?? null }}</td>
          <td>{{ $data['missing_at'] ?? null }}</td>
          <td>{{ $data['write_off'] ?? null }}</td>
        </tr>
      @endforeach
    </table>

  </body>
</html>
