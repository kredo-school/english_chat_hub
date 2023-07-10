import React from 'react';
import ReactDOM from 'react-dom';
import Welcome from './Welcome';


const thisElement = document.getElementById('root');
if (thisElement){
    let props = Object.assign([], thisElement.dataset);
    let urls = Object.assign([], thisElement.dataset);

    console.log(JSON.parse(props.list));
    console.log(JSON.parse(urls.url));


    ReactDOM.render(<Welcome reviews={JSON.parse(props.list)} urls={JSON.parse(urls.url)}/>, thisElement);
}



