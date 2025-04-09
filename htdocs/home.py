import os
import subprocess
from flask import Flask, render_template, request, Markup, send_from_directory, jsonify
from werkzeug.utils import secure_filename
import shlex
import graphviz

app = Flask(__name__)

app.config['UPLOAD_FOLDER'] = 'uploads'
app.config['MAX_CONTENT_PATH'] = 1000000
app.config['COMPILERS'] = ['synframe', 'synsem', 'lex', 'mph', 'framelp']

def user_specific_name(old_name):
    # To be adapted for the server probably 
    # When users are logged in,
    # it would make sense to have specific directories for users
    new_name =  secure_filename(request.remote_addr.replace('.','-') + old_name)
    return new_name

def remove_extension(filename):
    return '.'.join(filename.split('.')[:-1])

@app.route('/')
def home():
    #return render_template('home.html')
    return render_template('upload_viewer.html')

  
@app.route('/upload_viewer', methods = ['GET', 'POST'])
def upload_viewer():
    return render_template('upload_viewer.html')

@app.route('/save_and_view', methods = ['GET', 'POST'])
def save_and_view():
    # TODO: prefix file name with IP address
    if request.method == 'POST':
        f = request.files['file']
        filename = user_specific_name(f.filename)
        file_path = os.path.join(app.config['UPLOAD_FOLDER'],secure_filename(filename))
        f.save(file_path)
        file_content = Markup.escape(open(file_path,'r').read().replace('\n',''))
        return viewer(file_path, file_content)

def viewer(file_path, file_content):
    return render_template('viewer.html', file_path = file_path, file_content = file_content)

@app.route('/css/<path:filename>')
def serve_css(filename):
    return send_from_directory(os.path.join(app.root_path, 'css'), filename)

@app.route('/graph_exec', methods = ['POST', 'GET'])
def graph_exec():
    dot_input = request.form.get('text')
    svg_output = graphviz.Source(dot_input, format='svg').pipe()
    return svg_output
