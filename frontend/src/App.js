import React, { Component } from 'react';
import './App.css';
import { CarouselProvider, Slider, Slide, ButtonBack, ButtonNext } from 'pure-react-carousel';
import { Form, Image, Header } from "semantic-ui-react";
import request from './services/axios';
import 'pure-react-carousel/dist/react-carousel.es.css';
import 'semantic-ui-css/semantic.min.css'



class App extends Component {

  constructor(props) {
    super(props);

    this.state = { data: [], name: null, discount: null }

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleReload = this.handleReload.bind(this);
  }

  componentDidMount() {
    this.fetchData();
  }

  fetchData(name = 'all', discount = '') {

    discount = (discount === null || discount === '') ? '' : discount;
    name = (name === null || name === '') ? 'all' : name;

    request.get(`/get-data/${name}/${discount}`)
      .then(res => {
        console.log(`get data result ${res}`);
        this.setState({ data: res.data });
      })
  }

  handleSubmit(e) {
    e.preventDefault();

    this.fetchData(this.state.name, this.state.discount);
  }

  handleChange(e, { name, value }) {
    this.setState({ [name]: value });
  }

  handleReload() {
    this.setState({ data: [], name: null, discount: null })
    this.fetchData();
  }


  render() {
    let layout;
    if (this.state.data.length === 0) {
      layout = <div><h1>No Result Found</h1> <Form.Button onClick={this.handleReload}>Reload</Form.Button></div>;
    } else {
      layout = <CarouselProvider
        naturalSlideWidth={100}
        naturalSlideHeight={50}
        totalSlides={this.state.data.length}
      >
        <Slider style={{ textAlign: "center" }}>
          {this.state.data.map((slide, i) => {
            let discount_percent = `${slide.discount_percentage}% discount at`
            return (
              <Slide key={i} index={i}>
                <Image 
                label={{
                  as: 'a',
                  color: 'blue',
                  content: `${discount_percent} at ${slide.name}`,
                  icon: 'hotel',
                  ribbon: true,
                }}
                src={slide.image}
                style={{marginTop:'14%'}}></Image>
              </Slide>
            )
          })}
        </Slider>
        <ButtonBack style={{marginRight:'2%'}}>Back</ButtonBack>
        <ButtonNext>Next</ButtonNext>
        <Form style={{marginTop:'5%'}} onSubmit={this.handleSubmit}>
          <Form.Input
            type="text"
            name="name"
            label='Resort Name'
            placeholder='Enter name of resort'
            onChange={this.handleChange}
            style={{width:'50%'}}
          />
          <Form.Input
            type="number"
            name="discount"
            label='Discount Percentage'
            placeholder='%'
            style={{width:'10%'}}
            onChange={this.handleChange}
          />
          <Form.Button type="submit">Search</Form.Button>
        </Form>

      </CarouselProvider>
    }


    return (
      <div className="App" style={{width:'80%',margin:'auto'}}>
        <Header  block style={{marginTop:'2%',backgroundColor:'#7eb9ae'}}>
          <Image style={{width:'100%'}} src="https://privilee.ae/website/img/logo-white.b96a02ce.png"></Image>
        </Header>
        {/* <Grid centered verticalAlign='middle' style={{ height: '100vh' }}> */}
        {layout}
        {/* </Grid> */}
      </div>
    );
  }
}

export default App;
