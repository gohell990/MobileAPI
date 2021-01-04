import { ajax } from 'jquery';
import React, {Component, useEffect, useState} from 'react';
import PageLayout from '../layout/pageLayout';
import $ from 'jquery';
import axios from 'axios';

export default function login(){

    let textInput = React.createRef();
    let passwordInput = React.createRef();

    function handleChange(e){
        // let email = this.setState({input: e.target.value});
        console.log("Email=" + e.target.value);
        const [email] = e.target.value;
        console.log(email)
    }

    function handleClick() {
        console.log(textInput.current.value);
    }

    

    function setPassword(e){
        console.log("Password = " + e.target.value);
        const [password] = e.target.value;
        console.log(password)
    }

    function logging (props){
        // const [email, setEmail] = useState();


        console.log("logging in!");
        // http://localhost:8088/api/auth/login
        
            $.ajax({
                url: "https://staging.ecogreenapp.com/public/api/auth/login",
                type: "POST",
                header: {
                    "Access-Control-Allow-Origin": "*",
                    // "Authorization": "Bearer " + localStorage.getItem("_token"),
                },
                data:{
                    email: textInput.current.value,
                    password: passwordInput.current.value,
                },
                beforeSend: function(){
                    console.log("This token = " + localStorage.getItem("_token"))
                },
                success: function(data){
                    console.log("Before ")
                    console.log(data);
                    console.log("After")
                    // var finalData = JSON.parse(data)

                    $.each(data, function(key, value){
                        console.log("Key = " + key + " Value = " + value)

                        
                        if (key == "access_token"){
                            localStorage.setItem("_token", value)
                            console.log("Inside access_token now = " + value);
                            // $.each(value, function(valueKey, valueVal){
                            //     console.log("ValueKey = " + valueKey + " ValueVal = " + valueVal)
                            // })
                        }
                        // $.each(value, function(valueKey, valueVal){
                        //     console.log("ValueKey = " + valueKey + " valueVal = " + valueVal)
                        // })
                    })

                    console.log("This is TOKEN = " + localStorage.getItem("_token"));
                    window.location.href = "https://react.ecogreenapp.com/event";
                },
                error: function(request, status, error){
                    console.log("Error login = " + request.responseText);
                }
            })
            
         
    }
    // onClick={logging}
    
    return (
        <PageLayout user="">
            {/* action="http://localhost:8088/api/auth/login" */}
        {/* <form method="POST" action="http://localhost:8088/api/auth/login"> */}
            Email: <input type="text" name="email" onChange={handleChange} ref={textInput}/>
            Password:<input type="password" name="password" onChage={setPassword} ref={passwordInput}/>
            <button onClick={logging}>Login</button>
            {/* </form> */}
        </PageLayout>

    );

}

