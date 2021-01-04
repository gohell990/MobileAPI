import React from 'react'
import PageLayout from '../layout/pageLayout';
import CKEditor from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import ReactHtmlParser from 'react-html-parser';
 
export default function banner() {

    let textInput = React.createRef();
    
    // const [addData, setData] = "";
    let addData = "";

    function handleInput(e, editor){
        // const [text] = e.target.value;
        // console.log(text);
        const addData = editor.getData();
        // addData = data;
        
    }

    

    return (
        <PageLayout>
            <CKEditor editor={ClassicEditor} data={addData} onChange={handleInput} />
            <div>
                <p>
                {ReactHtmlParser(addData)}
                </p>
            </div>
        </PageLayout>
    )
}
