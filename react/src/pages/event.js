import React, {useState, state}from 'react'
import PageLayout from '../layout/pageLayout';
import { Table, Input, Button, Space } from 'antd';
import Highlighter from 'react-highlight-words';
import { SearchOutlined } from '@ant-design/icons';
import $ from 'jquery';
import axios from 'axios';

export default function event() {

  $(document).ready(function(){
    console.log("Event Page, Token = " + localStorage.getItem("_token"));
  })

  function refresh(){

    console.log("getUserNow!");
// http://localhost:8088/api/auth/refresh
    $.ajax({
      url: "https://staging.ecogreenapp.com/public/api/auth/refresh",
      method: "POST",
      header: "Access-Control-Allow-Origin: *",
      data: {

      },
      
      beforeSend: function(){
        console.log("Before refresh");
        console.log("Token = " + localStorage.getItem("_token"));
      },
      success: function(data){
        
      },
      complete: function(){
        console.log("Token now = " + localStorage.getItem("_token"));
      }
    })
  }

  function getMe(){
    console.log("getME now !");
    // http://localhost:8088/api/auth/me
    $.ajax({
      url: "https://staging.ecogreenapp.com/public/api/auth/me",
      method:"POST",
      headers: {
        "Access-Control-Allow-Origin": "*",
        // "Content-Type":"application/json",
        "Authorization": `Bearer ${localStorage.getItem("_token")}`,
        
      },
      
      beforeSend: function(xhr, settings){
        //do something here
        // console.log("Authorization = " + "Bearer " + localStorage.getItem("_token"));
        // xhr.setRequestHeader('Authorization','Bearer ' + localStorage.getItem("_token"));
        // xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
      },
      success: function(data){
        console.log("Where AM I now? " + data);
        
        $("#testing").append(data);
        
        if(data)
        {
          $.each(data, function(key, value){
            console.log("Key = " + key + " Value = " + value);
          })
        }
        else {
          window.location.href = "http://react.ecogreenapp.com/login";
        }
      }
    })
  }

  function returnMsg(){
    // e.preventDefault();
    // http://localhost:8088/api/auth/return
    $.ajax({
      url: "https://staging.ecogreenapp.com/public/api/auth/return",
      method: "GET",
      data:{

      },
      headers:{
        "Access-Control-Allow-Origin": "*",
        "Content-Type":"application/json",
        // 'Authorization':'Basic '+btoa("xmiy@gmail.com"+":"+"shinsin")
        "Authorization": `Bearer ${localStorage.getItem("_token")}`,
        
      },
      beforeSend:function(xhr){
        //do something here
        // xhr.setRequestHeader('Authorization', 'Bearer '  + localStorage.getItem("_token"));
      },
      success:function(response){
        

        $("#testing").append("Authorization " + localStorage.getItem("_token"));
        
        // let data = JSON.parse(response);
        // $("#anything").append(response);
        $.each(response, function(key, value){
          $("#anything").append("Key = " + key + " Value = " + value);
        })
        
        
      },
      
    })

    return false;
  }

//   function sending(){
//     // var express = require('express')
//     //   , cors = require('cors')
//     //   , app = express();
//     // app.options('*', cors()); // include before other routes
//     // app.listen(8088, function(){
//     //   console.log('CORS-enabled web server listening on port 8088');
//     // });
//     const config = {
//       headers: { Authorization: `Bearer ${localStorage.getItem("_token")}` }, 
//     };
//     axios.post("http://localhost:8088/api/auth/return",  config)
//     .then((res)=> {
//       console.log(res)
//       $("#testing").append(res)
//     })
//     .catch((err) => console.log(err));

    
//   }

  return (
      <div id="testing">
        <button style={{padding:"15px"}} onClick={getMe}>ME</button>
        <button style={{padding:"15px"}} onClick={refresh}>Refresh Token</button>
        <button style={{padding:"15px"}} onClick={returnMsg}>Message</button>
        <div id="anything">

        </div>
      </div>

      
  );
      
}
    