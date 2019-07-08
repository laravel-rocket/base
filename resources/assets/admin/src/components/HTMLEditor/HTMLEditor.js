import React from 'react';
import {Editor} from 'react-draft-wysiwyg'
import {EditorState, ContentState, convertToRaw, convertFromRaw, convertFromHTML} from 'draft-js'
import {stateToHTML} from 'draft-js-export-html';
import 'react-draft-wysiwyg/dist/react-draft-wysiwyg.css';

class HTMLEditor extends React.Component {
  constructor(props) {
    super(props);
    const blocksFromHTML = convertFromHTML(props.value || "<div>ANC</div>");
    if (blocksFromHTML && blocksFromHTML.contentBlocks) {
      this.state = {
        editorState: EditorState.createWithContent(ContentState.createFromBlockArray(
          blocksFromHTML.contentBlocks,
          blocksFromHTML.entityMap
        ))
      };
    } else {
      this.state = {editorState: EditorState.createEmpty()};
    }
    this.onEditorStateChange = (editorState) => {
//      console.log(editorState);
      this.setState({editorState});
      if (editorState) {
        const html = stateToHTML(editorState.getCurrentContent());
        console.log(html);
        props.onChange(html);
      }
    }
    this.onUploadFile = this.onUploadFile.bind(this);
  }

  onUploadFile(file) {

  }

  render() {
    return (
      <div className="html-editor__container">
        <Editor editorState={this.state.editorState}
                onEditorStateChange={(editorState) => {
                  this.onEditorStateChange(editorState)
                }}
                placeholder={this.props.placeholder}
                toolbar={{
                  inline: {inDropdown: true},
                  list: {inDropdown: true},
                  textAlign: {inDropdown: true},
                  link: {inDropdown: true},
                  history: {inDropdown: true},
                  image: {
                    uploadEnabled: true,
                    uploadCallback: this.onUploadFile
                  }
                }}
        />
      </div>
    );
  }
}

export default HTMLEditor;
