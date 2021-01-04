import { OmitProps } from 'antd/lib/transfer/ListBody';
import React from 'react';


export default function Hello({name, age, count}){

    return (
        <div>
            Name:<input type="text" value={name}></input>
            Age:<input type="text" value={age}></input>
            Count:<input type="text" value={count}></input>
        </div>
    )
}