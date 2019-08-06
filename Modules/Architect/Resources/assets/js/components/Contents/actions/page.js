import {
  INIT_PAGE_STATE,

} from "../constants/";

export function initPageState(content) {
  return { type: INIT_PAGE_STATE, payload : content }
};
