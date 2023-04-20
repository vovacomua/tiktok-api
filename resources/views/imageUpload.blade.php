<!DOCTYPE html>
<html>
<head>
    <title>Create TikTok Campaign</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
<div class="container">

    <div class="panel panel-primary">
      <div class="panel-heading"><h2>Create TikTok Campaign</h2></div>
      <div class="panel-body">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="col-md-6">
                    <input type="text" name="budget_mode" value="BUDGET_MODE_DAY" class="form-control">
                </div>

                <div class="col-md-6">
                    <input type="text" name="budget" value="1111" class="form-control">
                </div>

                <div class="col-md-6">
                    <input type="text" name="objective_type" value="REACH" class="form-control">
                </div>

                <div class="col-md-6">
                    <input type="text" name="campaign_name" value="MyCampaign" class="form-control">
                </div>

                <div class="col-md-6">
                    <input type="file" name="video" class="form-control">
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Upload and Create</button>
                </div>

        </form>

      </div>
    </div>
</div>
</body>

</html>
