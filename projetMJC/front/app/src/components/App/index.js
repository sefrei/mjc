/*
 * Npm import
 */
import React from 'react';
import { Route, Switch } from 'react-router-dom';

/*
 * Local import
 */
import Notebook from 'src/components/Notebook';
import Activity from 'src/containers/Activity';
import baseSite from 'src/siteUrl';
/*
 * Code
 */
const url = baseSite.baseSite;
const App = () => (
  <Switch>
    <Route
      path={`${url}activity/:id`}
      component={Activity}
    />
    <Route
      path="/"
      component={Notebook}
    />
  </Switch>
);
/*
 * Export default
 */
export default App;
