import {
  MODAL_CONTENT_OPEN,
  MODAL_CONTENT_CLOSE,
  MODAL_CONTENT_SELECT,
  MODAL_CONTENT_CLEAR
} from "../constants/";


export function openModalContents() {

  return {type : MODAL_CONTENT_OPEN};
}

export function closeModalContents() {

  return {type : MODAL_CONTENT_CLOSE};

}

export function selectContent(content) {

  return {type : MODAL_CONTENT_SELECT, payload:content};

}

export function clearContent() {

  return {type : MODAL_CONTENT_CLEAR};

}
