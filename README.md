##TikTok API App - Campaign creation

###Installation
- clone repository `git clone git@github.com:vovacomua/tiktok-api.git`
- go to its directory `cd tiktok-api`
- run container `./vendor/bin/sail up -d`
- install dependencies `./vendor/bin/sail composer install`
- in .env file set secret variables 
  `AWS_ACCESS_KEY_ID , AWS_SECRET_ACCESS_KEY , TIKTOK_TOKEN , 
  TIKTOK_ADVERTISER`
- Download updated package from here:
https://tiktok-bucket-1504.s3.eu-north-1.amazonaws.com/tiktok-marketing-api.zip
- Go to vendor/promopult and swap tiktok-marketing-api
with what you've downloaded
- Go to `http://localhost/image-upload` and upload video

Let me start from the package issue.

As using pure Guzzle to communicate with API is no good and reinventing wheel and creating you own wrapper 
is considered to be bad practice, I acted as I would 
while creating real world project and checked what's available. 
I found great package for TikTok Marketing API, and while it's not ready for production 
and lacks most of endpoints I'd definitely choose it as starting point for my project's API wrapper.

So I edited this package. If I had more time I could modify it so that it didn't need installation.

Another issue missed due to the lack of time is 
to create service to implement all logic, and move every API request to separate method.
Of cause having business logic in controller is bad practice as well as having long methods.
Unfortunatey I also have not completed Vue based form.
Also, more validation rules should be added, which also needs time to examine docs for every field of campaign.

I spent most time setting up AWS and TikTok accs and digging documentation to make API work.
Another time consuming part was to edit package's source code.

As for the architecture. 

There was a requirement to output API response after form submitting. Otherwise I'd make in work async,
by moving video file uploading and API calls to queue. I'd also create table to save campaign locally
and address it to check the status of campaign creation on Tiktok side. That's what we did for Amazon Ads API based project.

Btw, for more than a year I'd been involved in creation of innovative project based on Amazon Ads API. 
We created custom package - wrapper for Amazon Ads API endpints, as nothing similar was available and got lots of experience implementing that API, making asynchronous calls to Amazon API, syncing local and remote databases etc.
I got familiar familiar with concepts such as campaign creation, ad group creation, targeting options, and reporting. I've got understanding how to structure  code and how to work with API calls, since both APIs have similar design.







