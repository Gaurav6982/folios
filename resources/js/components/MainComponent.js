import React, { Component } from "react";
import { Switch, Route, Redirect } from "react-router-dom";
import Home from "./Home";
import Build from "./Build";

export class MainComponent extends Component {

    render() {
        return (
            <div>
                <Switch>
                    <Route path="/" component={Home} />
                    <Route exact path="/build" component={Build} />
                    <Redirect to="/" />
                </Switch>
            </div>
        );
    }
}

export default MainComponent;
