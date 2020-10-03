import React, { Component } from 'react';
import SignUp from './SignUp';
import {Link} from 'react-router-dom';

export class PageOne extends Component {
    constructor(props) {
        super(props);
        this.state = {
          isSignUpModalOpen: false
        };
        this.toggleModalSignUp = this.toggleModalSignUp.bind(this);

    }
    toggleModalSignUp(){
        this.setState({
            isSignUpModalOpen: !this.state.isSignUpModalOpen
        });
    }
    render() {
        return (
            <div>
            <div className="container" >
                <div className="row">
                    <div className="col-lg-5 homecontent" style={{marginTop:'50px',paddingRight:'30px'}}>
                        <h2 className="heading_one">Bring all of your links<br/> in one place</h2><br/>
                        <p>Keep all your important links on your fingure tips and such easy sharing is never possible before. An ideal place to keep and share your presence.</p>
                        <br/>
                        <button type="button" onClick={this.toggleModalSignUp} className="btn buttons btn-round btn-sm" style={{color:'#ffffff',fontSize:'15px'}} >Sign Up for FREE</button>
                        <br/><br/>
                        <img src="assets/images/img2.png" width="228px" height="26px" alt="img"/>
                    </div>
                    <div className="col-lg-7">
                        <center><img className="homepage-img" src="assets/images/img1.svg" style={{textAlign:'center', maxWidth:'100%', maxHeight:'100%'}} width="auto" alt="img"/></center>
                    </div>
                </div>
            </div>
            <Modal isOpen={this.state.isSignUpModalOpen} toggle={this.toggleModalSignUp}>
                <ModalHeader toggle={this.toggleModalSignUp}>Sign Up</ModalHeader>
                <ModalBody>
                    <br/>
                    <SignUp/>
                </ModalBody>
            </Modal>
            </div>
        )
    }
}

export default PageOne;
