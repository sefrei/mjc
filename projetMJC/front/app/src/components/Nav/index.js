/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import DatePicker from 'react-datepicker';
/*
 * Local import
 */
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const App = ({ currentDate, actions }) => {
  console.info(currentDate.format('DD/MM/YYYY'));
  // Change
  const onChange = (evt) => {
    actions.changeDate(evt);
  };

  return (
    <div id="notebook-navigation">
      <button className="toto"><i className="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
      <DatePicker
        dateFormat="DD/MM/YYYY"
        selected={currentDate}
        onChange={onChange}
        className="tata"
        locale="fr"
      />
      <button><i className="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
    </div>
  );
};

App.propTypes = {
  currentDate: PropTypes.object.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default App;
