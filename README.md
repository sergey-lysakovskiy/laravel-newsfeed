# Description

This is a demo application based on a Laravel framework. It shows the functionality 
of the Laravel Cache. For the proper work whether redis or memcached driver should be installed.
Application is using tags to manage the cache.

# How to use

## Step 1: Select User

To get list of users you need to perform API request  **GET** /api/users.

From the response you may pick the user's email you want to use for login.

## Step 2: Retrieve the token

Use API endpoint **POST** /api/login to log in. Use the following format for the request:
<pre>
{
    "email": [user_email],
    "password": "password"
}   
</pre>

In the response you will get the Bearer token which you should use in the next API calls.

## Step 3: Getting the post feed

Use API endpoint **GET** /api/feed to get the latest records. 

You may also change the sorting of the feed by the parameter **sort**. 
Available values: latest, earliest, random. 

If you want to change the count of records, use parameter **limit** (set to 50 by default).

## Step 4: Mute user

Use API endpoint **POST** /api/mute/{user} and provide the user id you want to mute.

To unmute user use API endpoint **POST** /api/unmute/{user}

To see muted user list use API endpoint **GET** /api/users/muted



