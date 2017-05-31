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
const Nav = ({ currentDate, actions }) => {
  // Change
  const onChange = (evt) => {
    console.info(evt);
    actions.changeDate(evt);
  };

  return (
    <div id="notebook-navigation">
      <button onClick={actions.downDay} id="left-arrow" className="nav-arrow"><i className="fa fa-arrow-circle-left" aria-hidden="true" /></button>
      <DatePicker
        dateFormat="DD/MM/YYYY"
        selected={currentDate}
        onChange={onChange}
        className="date-picker"
        locale="fr"
      />
      <button onClick={actions.upDay} id="right-arrow" className="nav-arrow"><i className="fa fa-arrow-circle-right" aria-hidden="true" /></button>
      <h2 id="date-title">{currentDate.format('dddd D MMMM YYYY')}</h2>
    </div>
  );
};

Nav.propTypes = {
  currentDate: PropTypes.object.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Nav;
